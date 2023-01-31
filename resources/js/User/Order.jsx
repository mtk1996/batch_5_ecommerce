import axios from "axios";
import React, { useEffect, useState } from "react";
import Spinner from "../Component/BtnSpinner";
const Order = () => {
    const [order, setOrder] = useState();
    const [loader, setLoader] = useState(true);
    const [data, setData] = useState({});
    const [page, setPage] = useState(1);
    useEffect(() => {
        setLoader(true);
        axios.get("/api/order?page=" + page).then((d) => {
            setOrder(d.data.data);
            setData(d.data);
            setLoader(false);
        });
    }, [page]);

    return (
        <div className="container">
            <div className="card">
                <div className="card-body">
                    {loader && (
                        <div className="d-flex p-5 justify-content-center align-items-center">
                            <Spinner />
                        </div>
                    )}

                    {!loader && (
                        <>
                            <table className="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {order.map((sOrder) => (
                                        <tr key={sOrder.id}>
                                            <td>
                                                <img
                                                    src={
                                                        sOrder.product.image_url
                                                    }
                                                    style={{ width: "10%" }}
                                                    className="img-thumbnail"
                                                />
                                            </td>
                                            <td>{sOrder.product.name}</td>
                                            <td>{sOrder.stock_qty}</td>
                                            <td>
                                                {sOrder.status == "success" && (
                                                    <span className="badge badge-success">
                                                        success
                                                    </span>
                                                )}

                                                {sOrder.status == "pending" && (
                                                    <span className="badge badge-warning">
                                                        pending
                                                    </span>
                                                )}
                                                {sOrder.status == "reject" && (
                                                    <span className="badge badge-danger">
                                                        reject
                                                    </span>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>

                            <button
                                disabled={data.prev_page_url == null && true}
                                className="btn btn-sm btn-dark"
                                onClick={() => setPage(page - 1)}
                            >
                                <i className="fas fa-arrow-left"></i>
                            </button>
                            <button
                                disabled={data.next_page_url == null && true}
                                className="btn btn-sm btn-dark"
                                onClick={() => setPage(page + 1)}
                            >
                                <i className="fas fa-arrow-right"></i>
                            </button>
                        </>
                    )}
                </div>
            </div>
        </div>
    );
};

export default Order;
