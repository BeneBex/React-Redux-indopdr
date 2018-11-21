import React, {Component, Fragment} from "react";
import PropTypes from "prop-types";
import connect from "react-redux/es/connect/connect";

class NewMessage extends Component {
    constructor(props) {
        super(props);

        this.state = {
            inhoud: 'test',
            categorienummer: 1,
            usernaam: 1
        };
    }

    render(){
        return (
        <Fragment>
            <div className="mdl-cell--4-offset mdl-cell--4-col">
                <h1>
                    plaats nieuw bericht
                </h1>
                <form className="mdl-cell--4-offset mdl-cell--4-col">
                    <div className="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input
                            className="mdl-textfield__input"
                            type="text"
                            id="content"
                            onChange={(e) => this.setState({inhoud: e.target.value })}
                        />
                        <label className="mdl-textfield__label" htmlFor="content">Bericht:</label>
                    </div>
                    <div className="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input className="mdl-textfield__input"
                               type="number"
                               id="category"
                               onChange={(e) => this.setState({categorienummer: e.target.value})}
                        />
                        <label className="mdl-textfield__label" htmlFor="category">categorienummer:</label>
                    </div>
                    <div>
                        <button
                            className="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"
                            onClick={createMessage}>
                            Plaats bericht
                        </button>
                    </div>
                </form>
            </div>
        </Fragment>
    )
    }
}

NewMessage.propTypes = {
    username: PropTypes.string,
}

function createMessage() {
    fetch("http://localhost:8000/newMessage", {
        method: 'post',
        body: JSON.stringify({
            'user': this.state.usernaam,
            'content': this.state.inhoud,
            'category': this.state.categorienummer
        })
    })
}

function mapStateToProps(state) {
    return {
        username: state.userInfo.name
    };
}

function mapDispatchToProps() {
    return {};
}

export default connect(mapStateToProps, mapDispatchToProps)(NewMessage);