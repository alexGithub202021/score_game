import React from "react";
import Axios from "axios";
import $ from 'jquery';

export default class CreateForm extends React.Component {

    state = {
        countriesList: []
    }

    async componentDidMount() {
        await Axios.get("http://localhost:88/api/teams")
            .then(res => {
                const countriesList = res.data;
                this.setState({ countriesList })
            }).catch(err => {
                console.log(err);
            })
    }

    create = (e) => {
        e.preventDefault();

        // get data form
        const home = $('form[name="gameCreationForm"] :input[name="homeTeam"]').val(),
            away = $('form[name="gameCreationForm"] :input[name="awayTeam"]').val();

        // validation
        if (0 == home || 0 == away) {
            alert('Please select two teams');
            return;
        } else if (home === away) {
            alert('Please select two different teams');
            return;
        } else {
            this.createGame([home, away]);
        }
    }

    // 
    async createGame(ids) {
        Axios({
            method: 'post',
            url: 'http://localhost:88/api/game',
            data: {
                score: "0;0",
                idTeam1: ids[0],
                idTeam2: ids[1]
            }
        }).then(res => {
            alert('New match created')
            window.location = "/score_board";
        }).catch(err => {
            console.log(err);
            alert('something goes wrong, please contact the admin...')
        });
    }

    render() {
        return (
            <div className="createForm">
                <span>> Create a football game:</span>
                <a href="/" className="absolute left-1/2 text-black-600 underline hover:text-blue-500">
                    <button className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Return
                    </button>
                </a>
                <br /><br />
                <form className="createMatchForm" name="gameCreationForm" onSubmit={this.create}>
                    <table className="" >
                        <tbody>
                            <tr>
                                <td className="pr-4 pl-6">
                                    <select className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="homeTeam" >
                                        <option value="0"> Select Home team </option>
                                        {
                                            this.state.countriesList.map(country =>
                                                <option key={country.idteam} value={country.idteam}>{country.name}</option>
                                            )
                                        }
                                    </select>
                                </td>
                                <td>
                                    <select className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="awayTeam">
                                        <option value="0"> Select Away team </option>
                                        {
                                            this.state.countriesList.map(country =>
                                                <option key={country.idteam} value={country.idteam}>{country.name}</option>
                                            )
                                        }
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colSpan="2" className="pt-6 pl-6">
                                    <button className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-0 rounded-full">
                                        Start the game
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div >
        );
    }
}
