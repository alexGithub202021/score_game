import { Link } from 'react-router-dom';

const Navbar = () => {
    return (
        <nav className="navBar">
            <div className="links">
                <Link to="/">Home</Link>&nbsp;
                | <Link to="/create_game">CreateGame</Link>&nbsp;
                | <Link to="/live_score_board">ScoreBoard</Link>&nbsp;
                | <Link to="/games_summary">Summary</Link>
            </div>
        </nav>
    );
}

export default Navbar;