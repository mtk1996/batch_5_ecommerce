import axios from "axios";
import React, { useState } from "react";

const ChangePassword = () => {
    const [currentPassword, setCurrentPassword] = useState("");
    const [newtPassword, setNewPassword] = useState("");
    const changePassword = () => {
        axios
            .post("/api/change-password", {
                new: newtPassword,
                current: currentPassword,
            })
            .then((d) => {
                const { data } = d;
                if (data == "wrong_current") {
                    errorToast("Wrong Current Password");
                    return;
                }
                if (data == "success") {
                    successToast("Password Changed");
                }
            });
    };
    return (
        <div className="container">
            <div className="card">
                <div className="card-body">
                    <div className="form-group">
                        <label htmlFor="">Current Password</label>
                        <input
                            type="password"
                            className="form-control"
                            onChange={(e) => setCurrentPassword(e.target.value)}
                        />
                    </div>
                    <div className="form-group">
                        <label htmlFor="">New Password</label>
                        <input
                            type="password"
                            className="form-control"
                            onChange={(e) => setNewPassword(e.target.value)}
                        />
                    </div>
                    <button className="btn btn-dark" onClick={changePassword}>
                        Change
                    </button>
                </div>
            </div>
        </div>
    );
};

export default ChangePassword;
