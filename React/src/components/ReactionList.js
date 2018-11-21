import Reactions from "./Reactions";
import React, {Component} from "react";
import axios from "axios";

class ReactionList extends Component{
    constructor(props) {
        super(props);

        this.state = {
            reactions: []
        }

        this.getReactions();
    }

    getReactions(){
        axios.get('http://localhost:8000/reactions/2').then(r => {
            this.setState(prevState => ({
                reactions: r.data
            }))
        });
    }

    render() {
        return (
            <div>
                <div className="mdl-grid">
                    {this.state.reactions.map((reaction)=>(
                        <Reactions
                            reaction={reaction}
                        />
                    ))}
                </div>
            </div>
        )
    }
}

export default ReactionList;
