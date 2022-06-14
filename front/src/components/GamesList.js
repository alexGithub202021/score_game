import { filterRows } from './Helpers'
import { useState } from "react"
import { useMemo } from "react"

export default function GamesList({ games }) {

    const [filter, setfilter] = useState("");
    const filteredRows = useMemo(() => filterRows(games, filter), [games, filter]);

    const handleFilter = (e) => {
        setfilter(e);
    }

    return (
        <div className="">
            <a href="/" className="absolute left-1/2 text-black-600 underline hover:text-blue-500">
                <button className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Return
                </button>
            </a>
            <br /><br />
            <input onChange={(e) => handleFilter(e.target.value)} type="text" id="simple-search" className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-grey-700 dark:focus:ring-blue-500 dark:focus:border-blue-500 w-4/12 ml-6 mb-8" placeholder="Search" required></input>
            <div className="gamesDiv">
                <table className="absolute left-6">
                    <tbody>
                        {
                            filteredRows.map(game =>
                                <tr key={game.idGame} className="hover:bg-blue-200">
                                    <td className="p-2 pr-1">{game.nameTeam1}</td>
                                    <td className="p-2 pr-6">{game.score.split(';')[0]}</td>
                                    <td className="p-2 pr-1">{game.nameTeam2}</td>
                                    <td className="p-2">{game.score.split(';')[1]}</td>
                                </tr>
                            )
                        }
                    </tbody>
                </table>
            </div>
        </div>
    );
}