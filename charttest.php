<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css">
  <style>
    #chart-container {
      display: flex;
      align-items: flex-end;
      flex-wrap: wrap;
    }

    .bar-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-right: 10px;
      margin-bottom: 10px;
      position: relative;
    }

    .bar {
      width: 60px;
      background-color: #3498db;
      color: #fff;
      text-align: center;
      line-height: 30px;
      margin-bottom: 5px;
      position: relative;
    }

    .withdrawal-bar {
      background-color: #e74c3c;
    }

    .tooltip {
      position: absolute;
      top: -50px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #3498db; /* Adjusted background color */
      color: #fff;
      padding: 10px;
      border-radius: 5px; /* Added border radius */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Added box-shadow */
      opacity: 0;
      transition: opacity 0.3s;
    }

    .bar:hover .tooltip {
      opacity: 1;
    }

    @media (max-width: 640px) {
      #chart-container {
        flex-direction: column;
      }

      .bar-container {
        margin-right: 0;
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>
  <div id="chart-container"></div>

  <script>
    // Sample data for the chart
    const investmentData = [
      { month: 'January', investment: 800 },
      { month: 'February', investment: 12000 },
      { month: 'March', investment: 4500 },
      { month: 'April', investment: 15000 },
      // Add more months as needed
    ];

    const withdrawalData = [
      { month: 'January', withdrawal: 200 },
      { month: 'February', withdrawal: 3000 },
      { month: 'March', withdrawal: 1000 },
      { month: 'April', withdrawal: 4000 },
      // Add more months as needed
    ];

    // Function to create the vertical bar chart
    function createVerticalBarChart(investmentData, withdrawalData) 
    {
      // Check if data is an array
      if (!Array.isArray(investmentData) || !Array.isArray(withdrawalData)) {
        console.error('Data is not an array');
        return;
      }

      // Check if data contains required properties
      const requiredProperties = ['month', 'investment'];
      const missingProperties = requiredProperties.filter(prop => !investmentData.every(item => prop in item));
      if (missingProperties.length > 0) {
        console.error(`Missing required properties in investment data: ${missingProperties.join(', ')}`);
        return;
      }

      // Check if data contains required properties
      const requiredWithdrawalProperties = ['month', 'withdrawal'];
      const missingWithdrawalProperties = requiredWithdrawalProperties.filter(prop => !withdrawalData.every(item => prop in item));
      if (missingWithdrawalProperties.length > 0) {
        console.error(`Missing required properties in withdrawal data: ${missingWithdrawalProperties.join(', ')}`);
        return;
      }

      // Calculate the maximum investment and withdrawal amounts
      const maxInvestment = Math.max(...investmentData.map(item => item.investment));
      const maxWithdrawal = Math.max(...withdrawalData.map(item => item.withdrawal));

      // Create the chart container
      const chartContainer = document.getElementById('chart-container');

      // Create a bar container for each month
      investmentData.forEach(item => {
        const barContainer = document.createElement('div');
        barContainer.className = 'bar-container';

        // Create the investment bar
        const scaledInvestmentHeight = (item.investment / maxInvestment) * 150;
        const investmentBar = document.createElement('div');
        investmentBar.className = 'bar';
        investmentBar.style.height = `${scaledInvestmentHeight}px`;
        investmentBar.textContent = item.investment;
        investmentBar.setAttribute('title', `Investment: ${item.investment}`); // Set tooltip text

        // Find the corresponding withdrawal data
        const correspondingWithdrawal = withdrawalData.find(wItem => wItem.month === item.month);

        if (correspondingWithdrawal) {
          // Create the withdrawal bar
          const scaledWithdrawalHeight = (correspondingWithdrawal.withdrawal / maxWithdrawal) * 150;
          const withdrawalBar = document.createElement('div');
          withdrawalBar.className = 'bar withdrawal-bar';
          withdrawalBar.style.height = `${scaledWithdrawalHeight}px`;
          withdrawalBar.textContent = correspondingWithdrawal.withdrawal;
          withdrawalBar.setAttribute('title', `Withdrawal: ${correspondingWithdrawal.withdrawal}`); // Set tooltip text

          // Append the bars to the bar container
          barContainer.appendChild(investmentBar);
          barContainer.appendChild(withdrawalBar);
        } else {
          // If there's no corresponding withdrawal data, only append the investment bar
          barContainer.appendChild(investmentBar);
        }

        // Create the tooltip
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip';
        tooltip.textContent = `${item.month}: ${item.investment} (Investment)`;

        // Append the tooltip to the bar container
        barContainer.appendChild(tooltip);

        // Create the label
        const label = document.createElement('div');
        label.textContent = item.month;

        // Append the label to the bar container
        barContainer.appendChild(label);

        // Append the bar container to the chart container
        chartContainer.appendChild(barContainer);
      });
    }

    // Call the function with the sample data
    createVerticalBarChart(investmentData, withdrawalData);
  </script>
</body>
</html>
