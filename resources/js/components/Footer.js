import React from "react";
import ReactDOM from "react-dom";

import TestwebscrapForm from "./Testwebscrap/TestwebscrapForm";

function Footer_1() {
    return (
        <div className="">
          <h3>Footer</h3>
        </div>
    );
}

export default Test;

if (document.getElementById("footer")) {
    ReactDOM.render(<Footer_1 />, document.getElementById("footer"));
}
