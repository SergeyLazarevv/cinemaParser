import React, { useState, useEffect } from 'react';
import DatePicker from '../DropDownMenu/DatePicker'

let Content = () => {
    
    const [films, setFilms] = useState([]);
    useEffect(() => {
        fetch('http://localhost:2000/rest/films/top-films')
           .then((response) => response.json())
           .then((data) => {
              console.log('1212',data);
              setFilms(data);
           })
           .catch((err) => {
              console.log(err.message);
           });
     }, []);

    return (
        <div className='app_content'>
            <DatePicker />
        </div>
    )
}

export default Content