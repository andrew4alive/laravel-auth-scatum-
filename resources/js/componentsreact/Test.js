import React from "react";
import ReactDOM from "react-dom";

import TestwebscrapForm from "./Testwebscrap/TestwebscrapForm";

function Test() {
    return (
        <div className="">
            <h3 className="text-center"> Test</h3>
            <div className="container">
                <div className="row">
                    <div className="col-1"></div>
                    <div className="col">
                    <TestwebscrapForm></TestwebscrapForm>
                    </div>
                    <div className="col-1"></div>
                </div>
            </div>
        </div>
    );
}

export default Test;

if (document.getElementById("main")) {
    ReactDOM.render(<Test />, document.getElementById("main"));
}
