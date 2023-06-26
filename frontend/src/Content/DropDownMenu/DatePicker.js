import React from 'react'

const minOffset = 0;
const maxOffset = 60; 

export default class DatePicker extends React.Component {
  constructor() {
    super();
    
    const thisYear = (new Date()).getFullYear();
    
    this.state = {
      thisYear: thisYear,
      selectedYear: thisYear
    }
  }
  
  onHandleChange = (evt) => {
    this.setState({ selectedYear: evt.target.value });
  };

  render() {
    const { thisYear, selectedYear } = this.state;
    const options = [];
    
    for (let i = minOffset; i <= maxOffset; i++) {
      const year = thisYear - i;
      options.push(<option value={year}>{year}</option>);
    }
    return (
      <div>
        <select value={this.selectedYear} onChange={this.onHandleChange}> 
          {options}
        </select>
      </div>
    );
  }
}

// export default DatePicker