import React from "react";
import Axios from "axios";
import LiveScore from "./LiveScore";

export default class ScoreBoard extends React.Component {
    
    state = {
        gamesList: []
    }

    async componentDidMount() {
        await Axios.get("http://localhost:88/api/games")
            .then(res => {
                const gamesList = res.data;
                this.setState({ gamesList })
            }).catch(err => {
                console.log(err);
            })
    }

    render() {
        return (
            <div className="ScoreBoard">
                <LiveScore games={this.state.gamesList} />
            </div>
        );
    }
}