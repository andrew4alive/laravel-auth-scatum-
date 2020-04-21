import React from "react";

export default () => {
    var _token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    return <input type="hidden" name="_token" value={_token} />;
};
