class PriorityQueue {
    constructor() {
      this.queue = [];
    }

    enqueue(call, priority) {
      const newCall = { call, priority };
      let added = false;
  

      for (let i = 0; i < this.queue.length; i++) {
        if (newCall.priority > this.queue[i].priority) {
          this.queue.splice(i, 0, newCall);
          added = true;
          break;
        }
      }
     
      if (!added) {
        this.queue.push(newCall);
      }
    }

    dequeue() {
      if (this.isEmpty()) {
        return "Queue is empty";
      }
      return this.queue.shift().call;
    }

    isEmpty() {
      return this.queue.length === 0;
    }
  
    // Affichage
    printQueue() {
      return this.queue.map(item => `${item.call} (Priority: ${item.priority})`).join(", ");
    }
  }

  const callQueue = new PriorityQueue();
  

  callQueue.enqueue("Call 1", 2);
  callQueue.enqueue("Call 2", 5);
  callQueue.enqueue("Call 3", 1);
  callQueue.enqueue("Call 4", 4);
  
  console.log("Queue status: " + callQueue.printQueue()); 
  

  console.log("Processing: " + callQueue.dequeue());
  console.log("Processing: " + callQueue.dequeue());
  console.log("Queue status: " + callQueue.printQueue());
  