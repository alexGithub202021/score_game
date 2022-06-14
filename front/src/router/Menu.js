import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import Home from '../components/Home';
import CreateGame from '../components/CreateGame';
import Summary from '../components/Summary';
import ScoreBoard from '../components/ScoreBoard';

export default function Menu() {
    return (
        <Router>
            <div className="menu">
                <br />
                <div className="Content">
                    <Switch>
                        <Route exact path="/">
                            <Home />
                        </Route>
                        <Route path="/create_game">
                            <CreateGame />
                        </Route>
                        <Route path="/score_board">
                            <ScoreBoard />
                        </Route>
                        <Route path="/summary">
                            <Summary />
                        </Route>
                    </Switch>
                </div>
            </div>
        </Router>
    );
}
