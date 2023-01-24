import React from "react";

const Cart = () => {
    return (
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
                <tr>
                    <td>
                        <img
                            style={{ width: "40px" }}
                            className="img-thumbnail"
                            src="http://localhost:8000/images/63bd38849d6f4computer1.jpeg"
                            alt=""
                        />
                    </td>
                    <td>Mac Book</td>
                    <td>12000000mmk</td>
                    <td>1</td>
                    <td>
                        <button className="btn btn-danger">-</button>
                        <button className="btn btn-danger">+</button>
                    </td>
                    <td>
                        <button className="btn btn-danger">
                            <i className="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    );
};

export default Cart;
