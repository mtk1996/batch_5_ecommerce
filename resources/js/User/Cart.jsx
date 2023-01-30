import axios from "axios";
import React, { useEffect, useState } from "react";

const Cart = () => {
    const [cart, setCart] = useState([]);
    useEffect(() => {
        axios.get("/api/cart").then((res) => {
            setCart(res.data);
        });
    }, []);

    const removeProduct = (id) => {
        axios.post("/api/remove-cart", { id }).then((res) => {
            if (res.data == "success") {
                const newCart = cart.filter((sCart) => sCart.id !== id); //[]
                setCart(newCart);
            }
        });
    };

    const addCartQty = (id) => {
        axios.post("/api/cart-qty/add", { id }).then((d) => {
            if (d.data === "success") {
                const newCart = cart.map((sCart) => {
                    if (sCart.id == id) {
                        sCart.stock_qty += 1;
                    }
                    return sCart;
                });
                setCart(newCart);
                successToast("Qty Updated.");
            }
        });
    };
    return (
        <div className="container">
            <table className="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Add/Reduce</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    {cart.map((sCart) => (
                        <tr key={sCart.id}>
                            <td>
                                <img
                                    style={{ width: "40px" }}
                                    className="img-thumbnail"
                                    src={sCart.product.image_url}
                                    alt=""
                                />
                            </td>
                            <td>{sCart.product.name}</td>
                            <td>{sCart.product.sale_price}mmk</td>
                            <td>{sCart.stock_qty}</td>
                            <td>
                                <button className="btn btn-danger">-</button>
                                <button
                                    className="btn btn-danger"
                                    onClick={() => addCartQty(sCart.id)}
                                >
                                    +
                                </button>
                            </td>
                            <td>
                                <button
                                    className="btn btn-danger"
                                    onClick={() => removeProduct(sCart.id)}
                                >
                                    <i className="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default Cart;
