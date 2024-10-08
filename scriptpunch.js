document.addEventListener('DOMContentLoaded', () => {
    const punchBtn = document.getElementById('punch-btn');
    const statusText = document.getElementById('status').querySelector('span');
    const logList = document.getElementById('log-list');
    let punchedIn = JSON.parse(localStorage.getItem('punchedIn')) || false;
    let logs = JSON.parse(localStorage.getItem('logs')) || [];
  
    const updateTime = () => {
      const now = new Date();
      document.getElementById('date').textContent = now.toLocaleDateString();
      document.getElementById('time').textContent = now.toLocaleTimeString();
    };
  
    const updateLogDisplay = () => {
      logList.innerHTML = logs.map(log => `<li>${log}</li>`).join('');
    };
  
    const dispatchPunchTime = (type, time) => {
      // Here you would send the punch-in/punch-out time to a server.
      // For this example, we'll just log it to the console.
      console.log(`Dispatching ${type} time: ${time}`);
    };
  
    punchBtn.addEventListener('click', () => {
      const now = new Date().toLocaleTimeString();
      punchedIn = !punchedIn;
      punchBtn.textContent = punchedIn ? 'Punch Out' : 'Punch In';
      statusText.textContent = punchedIn ? 'Punched In' : 'Not Punched In';
      statusText.style.color = punchedIn ? 'green' : 'red';
  
      const punchType = punchedIn ? 'Punch In' : 'Punch Out';
      logs.push(`${punchType} at ${now}`);
      localStorage.setItem('punchedIn', JSON.stringify(punchedIn));
      localStorage.setItem('logs', JSON.stringify(logs));
      updateLogDisplay();
      dispatchPunchTime(punchType, now);
    });
  
    // Initial setup
    punchBtn.textContent = punchedIn ? 'Punch Out' : 'Punch In';
    statusText.textContent = punchedIn ? 'Punched In' : 'Not Punched In';
    statusText.style.color = punchedIn ? 'green' : 'red';
    updateTime();
    updateLogDisplay();
    setInterval(updateTime, 1000); // Update time every second
  });
  