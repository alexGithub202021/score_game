import { useState } from "react";
import Axios from "axios";

export default function LiveScore({ games }) {

    const lastGameCreated = games[0];

    var idGame = 0,
        team1 = "",
        team2 = "";

    if (lastGameCreated) {
        idGame = lastGameCreated['idGame'];
        team1 = lastGameCreated['nameTeam1'];
        team2 = lastGameCreated['nameTeam2'];
    }

    const [homeScore, setHomeScore] = useState(0),
        [awayScore, setAwayScore] = useState(0);

    const upHomeScore = () => {
        const newHomeScore = homeScore + 1;
        setHomeScore(newHomeScore);
    }

    const downHomeScore = () => {
        if (homeScore > 0) {
            const newHomeScore = homeScore - 1;
            setHomeScore(newHomeScore);
        }
    }

    const upAwayScore = () => {
        const newAwayScore = awayScore + 1;
        setAwayScore(newAwayScore);
    }

    const downAwayScore = () => {
        if (awayScore > 0) {
            const newAwayScore = awayScore - 1;
            setAwayScore(newAwayScore);
        }
    }

    const finishGame = () => {
        updateScore();
    }

    async function updateScore() {
        Axios({
            method: 'patch',
            url: 'http://localhost:88/api/score/' + idGame,
            data: {
                score: "" + homeScore + ";" + awayScore + ""
            }
        }).then(res => {
            alert('Game registered')
            window.location = "/";
        }).catch(err => {
            console.log(err);
            alert('something goes wrong, please contact the admin...')
        });
    }


    return (
        <div className="liveScore">
            <span>> {team1} vs {team2}:</span>
            <br />
            <br />
            <div className="liveScore">
                <fieldset className="border-solid rounded-md border-2 border-black max-w-3xl w-auto">
                    <table className="left-10 relative">
                        <tbody>
                            <tr>
                                <td colSpan="3" className="h-16"> </td>
                            </tr>
                            <tr className="text-5xl">
                                <td className="pl-24 w-24">{team1}</td>
                                <td className="pr-8 pl-8 text-4xl">{homeScore} - {awayScore}</td>
                                <td className="pr-32 w-24">{team2}</td>
                            </tr>
                            <tr>
                                <td className="pl-32 pt-6 text-center">Home</td>
                                <td></td>
                                <td className="pr-32 pt-6 text-center">Away</td>
                            </tr>
                            <tr>
                                <td colSpan="3" className="h-16"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table className="absolute right-1/3 top-14">
                        <tbody>
                            <tr>
                                <td className="w-8 pr-4 pb-9 pt-6">Home: </td>
                                <td className="pb-9 pt-6">
                                    <span onClick={upHomeScore} className="pr-2 text-xl">+ </span>
                                    <span onClick={downHomeScore} className="pr-2 text-xl">-</span>
                                </td>
                            </tr>
                            <tr>
                                <td className="w-8 pr-4 pb-6">Away:</td>
                                <td className="pb-6">
                                    <span onClick={upAwayScore} className="pr-2 text-xl">+ </span>
                                    <span onClick={downAwayScore} className="pr-2 text-xl">-</span>
                                </td>
                            </tr>
                            <tr>
                                <td colSpan="2">
                                    <button onClick={finishGame} className="pr-mt-4 w-32 bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                                        Finish
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>
    );
}