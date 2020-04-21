import React from "react";

import FormTextgroup from "../formhelper/FormTextgroup";
import CSRFtoken from "../formhelper/CSRFtoken";


const TestwebscrapForm = () => {
    return (
        <form method="post" action ="/webscrap">
            <CSRFtoken></CSRFtoken>
            <FormTextgroup
                lable={"Url"}
                inputtype={"url"}
                id={"url"}
                name={"url"} helptext="url to scrap"
            ></FormTextgroup>
            <FormTextgroup
                lable={"Query to scrap"}
                inputtype={"text"}
                id={"docquery"}
                name={"docquery"} helptext="Query Selector like jquery"
            ></FormTextgroup>
            
            <button type="submit" className="btn btn-primary">
                Submit
            </button>
        </form>
    );
};

export default TestwebscrapForm;
