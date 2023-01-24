import React from "react";
import { createRoot } from "react-dom/client";
import { HashRouter, Routes, Route, Link } from "react-router-dom";
import Cart from "./Cart";
import Order from "./Order";
import ChangePassword from "./ChangePassword";

const ProfileRouter = () => {
    return (
        <HashRouter>
            <div className="container mt-5">
                <Link to={"/"} className="btn btn-dark">
                    Cart
                </Link>
                <Link to={"/order"} className="btn btn-dark">
                    Order
                </Link>
            </div>
            <Routes>
                <Route path="/" element={<Cart />} />
                <Route path="/order" element={<Order />} />
                <Route path="/password" element={<ChangePassword />} />
            </Routes>
        </HashRouter>
    );
};

createRoot(document.getElementById("root")).render(<ProfileRouter />);
