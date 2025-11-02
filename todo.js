function addTask() {
  const input = document.getElementById("new_task");
  const taskText = input.value.trim();
  if (taskText === "") {
    alert("Please enter a task.");
    return;
  }

  const li = document.createElement("li");
  li.textContent = taskText;

  li.onclick = function() {
    li.classList.toggle("done");
  };

  const delBtn = document.createElement("button");
  delBtn.textContent = "Delete";
  delBtn.onclick = function() {
    li.remove();
  };

  li.appendChild(delBtn);
  document.getElementById("task_list").appendChild(li);
  input.value = "";
}
