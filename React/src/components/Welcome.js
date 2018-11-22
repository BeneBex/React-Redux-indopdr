import React from "react";
import emoji from 'react-easy-emoji'

const Welcome = (props) => {

    return (
        <div className="mdl-grid mdl-cell--1-offset">
            <h2 className="mdl-cell mdl-cell--12-col">Welkom op het forum</h2>
            <div className="mdl-cell--3-offset mdl-cell--4-col">
                <p>
                    <br/><br/>
                    Dit forum is ontwikkeld in React en zou een userinterface moeten voorstellen.
                    Dit forum gaat een PHP Rest api consumeren <br/><br/>
                    Enjoy!{ emoji('😀') }
                </p>
            </div>
        </div>
    )
}

export default Welcome;