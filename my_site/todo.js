let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
renderList(); 

function addTask() {
  const input = document.getElementById("new_task");
  const taskText = input.value.trim();
  if (taskText === "") {
    alert("Please enter a task.");
    return;
  }

  const newTask = {
    text: taskText,
    id: Date.now()
  };
  tasks.push(newTask);
  localStorage.setItem("tasks", JSON.stringify(tasks));

  renderItem(newTask.text, newTask.id);
  input.value = "";
}

function renderItem(text, id) {
  const ul = document.getElementById("task_list");
  const li = document.createElement("li");
  li.dataset.id = id;

  const spanText = document.createElement("span");
  spanText.textContent = text;
  li.appendChild(spanText);

  const delBtn = document.createElement("button");
  delBtn.textContent = "Delete";
  delBtn.addEventListener("click", () => {
    li.remove();
    tasks = tasks.filter(t => t.id !== id);
    localStorage.setItem("tasks", JSON.stringify(tasks));
  });
  li.appendChild(delBtn);

  spanText.addEventListener("click", () => li.classList.toggle("done"));

  ul.appendChild(li);
}

function renderList() {
  document.getElementById("task_list").innerHTML = "";
  tasks.forEach(t => renderItem(t.text, t.id));
}

