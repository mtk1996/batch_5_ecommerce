import axios from "axios";
import React, { useEffect, useState } from "react";
import { createRoot } from "react-dom/client";
import BtnSpinner from "./Component/BtnSpinner";
import StarRatings from "react-star-ratings";
//@params PRODUCT_DETAIL
const product_detail = PRODUCT_DETAIL;
const auth = AUTH;
const ProductDetail = () => {
    const [cartLoader, setCartLoader] = useState(false);
    const [reviewLoader, setReviewLoader] = useState(true);
    const [reviews, setReviews] = useState([]);

    const [btnReviewLoader, setBtnReviewLoader] = useState(false);
    const [ratingCount, setRatingCount] = useState(0);
    const [txtReview, setTxtReview] = useState("");
    //hooks
    useEffect(() => {
        const product_slug = product_detail.slug;
        axios.get("/api/product-review/" + product_slug).then(({ data }) => {
            setReviewLoader(false);
            setReviews(data);
        });
    }, []);

    const makeReview = () => {
        setBtnReviewLoader(true);
        var data = {
            product_slug: product_detail.slug,
            review: txtReview,
            rating: ratingCount,
        };
        axios.post("/api/make-review", data).then(({ data }) => {
            setBtnReviewLoader(false);
            if (data == "success") {
                const newReviewData = {
                    user: auth,
                    review: txtReview,
                    rating: ratingCount,
                };
                setReviews([...reviews, newReviewData]);
                successToast("Review Success.");
            }
        });
    };
    const addToCart = () => {
        const product_slug = product_detail.slug;
        const data = { product_slug };
        setCartLoader(true);
        axios.post("/api/add-to-cart", data).then((res) => {
            setCartLoader(false);
            const { data } = res;
            if (data == "not_auth") {
                errorToast("Please Login First");
                return;
            }
            updateCartQty(data.cart_qty);
            successToast("Added To Cart");
        });
    };
    return (
        <div className="card p-4">
            <div className="row">
                <div className="col-12 mb-3">
                    <h3>{product_detail.name}</h3>
                    <div>
                        <small className="text-muted">Brand:</small>
                        <small>{product_detail.brand.name}</small>|
                        <small className="text-muted">Category:</small>
                        <small className="text-dark">
                            {product_detail.category.map((sC) => (
                                <span key={sC.id}>{sC.name} </span>
                            ))}
                        </small>
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
                                <strike>
                                    {product_detail.discounted_price}ks
                                </strike>
                            </small>
                            <span className="text-danger fs-1 d-inline">
                                {product_detail.sale_price}ks
                            </span>
                            <br />
                            <span className="btn btn-sm btn-outline-success text-success mt-3">
                                InStock :{product_detail.stock_qty}
                            </span>
                            <button
                                disabled={cartLoader}
                                className="btn btn-sm btn-danger mt-3"
                                onClick={addToCart}
                            >
                                <i className="fas fa-shopping-cart" />
                                Add To Cart
                                {cartLoader && <BtnSpinner />}
                            </button>
                        </p>

                        <div
                            className="mt-5"
                            dangerouslySetInnerHTML={{
                                __html: product_detail.description,
                            }}
                        ></div>
                        <small className="text-muted">Available Color:</small>
                        <span className="badge badge-danger">Red</span>
                        <span className="badge badge-danger">Green</span>
                        <span className="badge badge-danger">Blue</span>
                    </div>
                </div>
                <hr />
                <div className="col-12" style={{ marginTop: 100 }}>
                    {/* loop review */}
                    {reviewLoader && (
                        <div className="d-flex justify-content-center align-items-center p-5">
                            <BtnSpinner />
                        </div>
                    )}

                    {!reviewLoader && (
                        <>
                            {reviews.map((sReview) => (
                                <div className="review" key={sReview.id}>
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
                                                    <StarRatings
                                                        rating={sReview.rating}
                                                        numberOfStars={5}
                                                        starDimension="15px"
                                                        starRatedColor="#FB6340"
                                                    />
                                                </div>
                                                <div className="name">
                                                    <b>{sReview.user.name}</b>
                                                </div>
                                                <div className="mt-3">
                                                    <small>
                                                        {sReview.review}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </>
                    )}

                    <div className="add-review mt-5">
                        <h4>Make Review</h4>
                        {auth !== null ? (
                            <>
                                <div>
                                    <StarRatings
                                        rating={ratingCount}
                                        changeRating={(count) => {
                                            setRatingCount(count);
                                        }}
                                        numberOfStars={5}
                                        starDimension="25px"
                                        starRatedColor="#FB6340"
                                    />
                                </div>
                                <div>
                                    <textarea
                                        className="form-control"
                                        rows={5}
                                        placeholder="enter review"
                                        onChange={(e) =>
                                            setTxtReview(e.target.value)
                                        }
                                    />
                                    <button
                                        disabled={btnReviewLoader}
                                        onClick={makeReview}
                                        className="btn btn-dark float-right mt-3"
                                    >
                                        Review
                                        {btnReviewLoader && <BtnSpinner />}
                                    </button>
                                </div>
                            </>
                        ) : (
                            <div className="alert alert-danger">
                                Please Login first.
                                <a
                                    href="/login"
                                    className="btn btn-dark btn-sm"
                                >
                                    Login
                                </a>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );
};
createRoot(document.getElementById("root")).render(<ProductDetail />);
