function callLogs(callLogs) {
  let totalDuration = 0;
  let resolutionSuccessCount = 0;
  let hourlyCallCount = Array(24).fill(0);

  callLogs.forEach(log => {
    totalDuration += log.duration;

    if (log.status === 'resolved') {
      resolutionSuccessCount++;
    }
    const hour = new Date(log.timestamp).getHours();
    hourlyCallCount[hour]++;
  });
  const avgDuration = totalDuration / callLogs.length;

  const busiestHour = hourlyCallCount.indexOf(Math.max(...hourlyCallCount));

  const successRate = (resolutionSuccessCount / callLogs.length) * 100;

  return {
    avgDuration,
    busiestHour,
    successRate
  };
}
const callLogs = [
  { duration: 120, timestamp: '2024-09-19T10:15:00', status: 'resolved' },
  { duration: 60, timestamp: '2024-09-19T11:30:00', status: 'unresolved' },
  { duration: 180, timestamp: '2024-09-19T14:00:00', status: 'resolved' },
];

const result = callLogs(callLogs);

console.log(result);