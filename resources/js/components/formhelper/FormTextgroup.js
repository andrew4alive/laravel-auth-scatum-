import React from "react";

export default props => {
    const { lable, id, name, inputtype, helptext } = props;
    return (
        <div className="form-group">
            <label htmlFor="url">{lable}</label>
            <input
                type={inputtype}
                className="form-control"
                id={id}
                name={name}
                aria-describedby={id + "Help"}
                placeholder="Enter email"
            />
            <Smallhelp id={id} helptext={helptext} ></Smallhelp>
        </div>
    );
};

const Smallhelp = (props) => {
    const { id,helptext } =props;
    if(!helptext) return null;
    return (
        <small id={id + "Help"} className="form-text text-muted">
            {helptext}
        </small>
    );
};
