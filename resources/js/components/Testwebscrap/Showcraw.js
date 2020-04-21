import React from 'react';
import ReactDOM from 'react-dom';

export default  (props)=>{
    const { request,crawdata } = props;
    return (
        <div className="container">
            <div className="row"></div>
        </div>

    );
}


if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}