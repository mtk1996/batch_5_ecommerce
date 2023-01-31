import axios from "axios";
import React, { useEffect, useState } from "react";

const Cart = () => {
    const [cart, setCart] = useState([]);
    const [phone, setPhone] = useState("");
    const [address, setAddress] = useState("");
    const [image, setImage] = useState("");
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

    const total = () => {
        var totalPrice = 0;
        cart.map((sCart) => {
            totalPrice += sCart.stock_qty * sCart.product.sale_price;
        });
        return totalPrice;
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

    const chooseImage = (e) => {
        setImage(e.target.files[0]);
    };

    const makeOrder = () => {
        const frmData = new FormData();
        frmData.append("phone", phone);
        frmData.append("address", address);
        frmData.append("image", image);
        axios.post("/api/make-order", frmData).then((d) => {
            if (d.data == "success") {
                setCart([]);
                successToast("Order Success.");
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
                    <tr>
                        <td colSpan={5}>
                            <h5 className="text-center">Total</h5>
                        </td>
                        <td>
                            <h5>{total()}mmk</h5>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div className="card">
                <div className="card-body">
                    <div className="form-group">
                        <label htmlFor="">Enter Phone</label>
                        <input
                            type="number"
                            className="form-control"
                            onChange={(e) => setPhone(e.target.value)}
                        />
                    </div>
                    <div className="form-group">
                        <label htmlFor="">Payment Screenshot </label>
                        <input
                            type="file"
                            className="form-control"
                            onChange={chooseImage}
                        />
                    </div>
                    <div className="form-group">
                        <label htmlFor="">Shipping Address </label>
                        <textarea
                            className="form-control"
                            onChange={(e) => setAddress(e.target.value)}
                        ></textarea>
                    </div>
                </div>
            </div>
            <button className="btn btn-dark" onClick={makeOrder}>
                Order Now
            </button>
        </div>
    );
};

export default Cart;
