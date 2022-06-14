import React from "react";
import Axios from "axios";
import GamesList from "./GamesList";

export default class Summary extends React.Component {

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
                alert('something goes wrong, please contact the admin...')
            })
    }

    render() {
        return (
            <div className="summary">
                <span>> Summary:</span>
                <GamesList games={this.state.gamesList} />
            </div>
        );
    }
}