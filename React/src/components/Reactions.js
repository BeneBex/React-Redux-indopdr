import React from 'react';
import PropTypes from "prop-types";

const Reactions = (props) => {
    return (
        <div className="mdl-cell--4-col">
            <div className="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col">
                <div className="mdl-card__title">
                    <h3 className="mdl-cell--1-offset">Bericht 2</h3>
                </div>
                <div className="mdl-card__supporting-text mdl-cell--1-offset">
                    <h6>Reactie:</h6>
                    <p>{props.reaction}</p>
                </div>
            </div>
        </div>
    )
}

Reactions.propTypes = {
    reaction: PropTypes.object,
}

export default Reactions;