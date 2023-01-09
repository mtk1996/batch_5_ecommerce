import React from "react";
import { createRoot } from "react-dom/client";

const ProductDetail = () => {
    const addToCart = () => {};
    return (
        <div className="card p-4">
            <div className="row">
                <div className="col-12 mb-3">
                    <h3>Best Speakers</h3>
                    <div>
                        <small className="text-muted">Brand:</small>
                        <small>Samsung</small>|
                        <small className="text-muted">Category:</small>
                        <small className="badge badge-dark">Red</small>
                    </div>
                </div>
                <div className="col-12 col-sm-12 col-md-4 col-lg-4">
                    <img
                        className="w-100"
                        src="assets/images/product2.jpeg"
                        alt=""
                    />
                </div>
                <div className="col-12 col-sm-12 col-md-8 col-lg-8">
                    <div className="mt-5">
                        <p>
                            <small className="text-muted">
                                <strike>25000ks</strike>
                            </small>
                            <span className="text-danger fs-1 d-inline">
                                20000ks
                            </span>
                            <br />
                            <span className="btn btn-sm btn-outline-success text-success mt-3">
                                InStock :10
                            </span>
                            <span
                                className="btn btn-sm btn-danger mt-3"
                                onClick={addToCart}
                            >
                                <i className="fas fa-shopping-cart" />
                                Add To Cart
                            </span>
                        </p>
                        <p className="mt-5">
                            Vivamus adipiscing nisl ut dolor dignissim semper.
                            Nulla luctus malesuada tincidunt. Class aptent
                            taciti sociosqu ad litora torquent
                        </p>
                        <small className="text-muted">Available Color:</small>
                        <span className="badge badge-danger">Red</span>
                        <span className="badge badge-danger">Green</span>
                        <span className="badge badge-danger">Blue</span>
                    </div>
                </div>
                <hr />
                <div className="col-12" style={{ marginTop: 100 }}>
                    {/* loop review */}
                    <div className="review">
                        <div className="card p-3">
                            <div className="row">
                                <div className="col-md-2">
                                    <div className="d-flex justify-content-between">
                                        <img
                                            className="w-100 rounded-circle"
                                            src="assets/images/user.jpeg"
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <div className="col-md-10">
                                    <div className="rating">
                                        <small className="far fa-star text-warning" />
                                        <small className="far fa-star text-warning" />
                                        <small className="far fa-star" />
                                        <small className="far fa-star" />
                                        <small className="far fa-star" />
                                    </div>
                                    <div className="name">
                                        <b>Myo Thant Kyaw</b>
                                    </div>
                                    <div className="mt-3">
                                        <small>
                                            Lorem ipsum dolor sit amet
                                            consectetur adipisicing elit.
                                            Laborum ipsam vero ex fugit maiores
                                            officiis sit fuga nihil! Maiores
                                            laboriosam consequuntur explicabo
                                            vitae dolorum exercitationem optio,
                                            veritatis nulla ab expedita.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="review">
                        <div className="card p-3">
                            <div className="row">
                                <div className="col-md-2">
                                    <div className="d-flex justify-content-between">
                                        <img
                                            className="w-100 rounded-circle"
                                            src="assets/images/user.jpeg"
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <div className="col-md-10">
                                    <div className="rating">
                                        <small className="far fa-star text-warning" />
                                        <small className="far fa-star text-warning" />
                                        <small className="far fa-star" />
                                        <small className="far fa-star" />
                                        <small className="far fa-star" />
                                    </div>
                                    <div className="name">
                                        <b>Myo Thant Kyaw</b>
                                    </div>
                                    <div className="mt-3">
                                        <small>
                                            Lorem ipsum dolor sit amet
                                            consectetur adipisicing elit.
                                            Laborum ipsam vero ex fugit maiores
                                            officiis sit fuga nihil! Maiores
                                            laboriosam consequuntur explicabo
                                            vitae dolorum exercitationem optio,
                                            veritatis nulla ab expedita.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="add-review mt-5">
                        <h4>Make Review</h4>
                        <div className="">
                            <small className="far fa-star" />
                            |
                            <small className="far fa-star" />
                            <small className="far fa-star" />
                            |
                            <small className="far fa-star" />
                            <small className="far fa-star" />
                            <small className="far fa-star" />
                            |
                            <small className="far fa-star" />
                            <small className="far fa-star" />
                            <small className="far fa-star" />
                            <small className="far fa-star" />
                            |
                            <small className="far fa-star" />
                            <small className="far fa-star" />
                            <small className="far fa-star" />
                            <small className="far fa-star" />
                            <small className="far fa-star" />
                        </div>
                        <div>
                            <textarea
                                className="form-control"
                                rows={5}
                                placeholder="enter review"
                                defaultValue={""}
                            />
                            <button className="btn btn-dark float-right mt-3">
                                Review
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};
createRoot(document.getElementById("root")).render(<ProductDetail />);
