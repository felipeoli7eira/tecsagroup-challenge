import envs from "../../envs.js";
import statusMap from "./../statusMap.js";

export class Read {
  trashIcon =
    '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" fill="white" width="17" height="17" viewBox="0 0 128 128"><path d="M 49 1 C 47.34 1 46 2.34 46 4 C 46 5.66 47.34 7 49 7 L 79 7 C 80.66 7 82 5.66 82 4 C 82 2.34 80.66 1 79 1 L 49 1 z M 24 15 C 16.83 15 11 20.83 11 28 C 11 35.17 16.83 41 24 41 L 101 41 L 101 104 C 101 113.37 93.37 121 84 121 L 44 121 C 34.63 121 27 113.37 27 104 L 27 52 C 27 50.34 25.66 49 24 49 C 22.34 49 21 50.34 21 52 L 21 104 C 21 116.68 31.32 127 44 127 L 84 127 C 96.68 127 107 116.68 107 104 L 107 40.640625 C 112.72 39.280625 117 34.14 117 28 C 117 20.83 111.17 15 104 15 L 24 15 z M 24 21 L 104 21 C 107.86 21 111 24.14 111 28 C 111 31.86 107.86 35 104 35 L 24 35 C 20.14 35 17 31.86 17 28 C 17 24.14 20.14 21 24 21 z M 50 55 C 48.34 55 47 56.34 47 58 L 47 104 C 47 105.66 48.34 107 50 107 C 51.66 107 53 105.66 53 104 L 53 58 C 53 56.34 51.66 55 50 55 z M 78 55 C 76.34 55 75 56.34 75 58 L 75 104 C 75 105.66 76.34 107 78 107 C 79.66 107 81 105.66 81 104 L 81 58 C 81 56.34 79.66 55 78 55 z"></path></svg>';
  status;

  constructor() {
    console.log("[Read] module mounted 🚀");

    this.status = statusMap;
  }

  mount() {
    this.read();
  }

  async read() {
    try {
      const request = await fetch(envs.apiUrl.concat("/tasks"));

      if (request.status !== 200) {
        alert("Erro ao listar as tarefas");
        return;
      }

      const response = await request.json();

      this.mountTable(response);
    } catch (error) {
      console.log(error);
      alert("Erro ao listar as tarefas");
    }
  }

  mountTable(data) {
    this.mountToDoTab(data.filter((t) => t.status === "do"));
    this.mountDoingTab(data.filter((t) => t.status === "doing"));
    this.mountDoneTab(data.filter((t) => t.status === "done"));
  }

  mountToDoTab(data) {
    const table = document.querySelector("table#to-do-tasks tbody");
    table.innerHTML = "";

    data.map((task) => {
      const row = table.insertRow();

      // change status button: doing
      const changeSttsToDoingBtn = document.createElement("button");
      changeSttsToDoingBtn.classList.add("btn", "btn-primary", "btn-sm");
      changeSttsToDoingBtn.innerHTML = "Fazendo";
      changeSttsToDoingBtn.onclick = () => this.changeStatus(task, "doing");

      // change status button: done
      const changeSttsToDoneBtn = document.createElement("button");
      changeSttsToDoneBtn.classList.add("btn", "btn-success", "btn-sm", "ms-1");
      changeSttsToDoneBtn.innerHTML = "Feito(a)";
      changeSttsToDoneBtn.onclick = () => this.changeStatus(task, "done");

      const updateLink = document.createElement("a");
      updateLink.setAttribute("href", "/edicao/".concat(task.id.toString()));
      updateLink.textContent = task.title;

      row
        .insertCell()
        .appendChild(updateLink)
        .classList.add("fw-semibold", "text-nowrap");

      const descriptionCell = row.insertCell();
      descriptionCell.classList.add("text-nowrap");
      descriptionCell.textContent = task.description;

      const changeSttsCell = row.insertCell();
      changeSttsCell.classList.add("d-flex", "flex-nowrap");
      changeSttsCell.append(changeSttsToDoingBtn);
      changeSttsCell.append(changeSttsToDoneBtn);

      const deleteButton = document.createElement("button");
      deleteButton.classList.add("btn", "btn-danger", "btn-sm");

      deleteButton.innerHTML = this.trashIcon;
      deleteButton.onclick = () => this.destroy(task);

      row.insertCell().appendChild(deleteButton);
    });
  }

  mountDoingTab(data) {
    const table = document.querySelector("table#doing-tasks tbody");
    table.innerHTML = "";

    data.map((task) => {
      const row = table.insertRow();

      // change status button: do
      const changeSttsToDoBtn = document.createElement("button");
      changeSttsToDoBtn.classList.add("btn", "btn-primary", "btn-sm");
      changeSttsToDoBtn.innerHTML = "Fazer";
      changeSttsToDoBtn.onclick = () => this.changeStatus(task, "do");

      // change status button: done
      const changeSttsToDoneBtn = document.createElement("button");
      changeSttsToDoneBtn.classList.add("btn", "btn-success", "btn-sm", "ms-1");
      changeSttsToDoneBtn.innerHTML = "Feito(a)";
      changeSttsToDoneBtn.onclick = () => this.changeStatus(task, "done");

      const updateLink = document.createElement("a");
      updateLink.setAttribute("href", "/edicao/".concat(task.id.toString()));
      updateLink.textContent = task.title;

      row
        .insertCell()
        .appendChild(updateLink)
        .classList.add("fw-semibold", "text-nowrap");

      const descriptionCell = row.insertCell();
      descriptionCell.classList.add("text-nowrap");
      descriptionCell.textContent = task.description;

      const changeSttsCell = row.insertCell();
      changeSttsCell.classList.add("d-flex", "flex-nowrap");
      changeSttsCell.append(changeSttsToDoBtn);
      changeSttsCell.append(changeSttsToDoneBtn);

      const deleteButton = document.createElement("button");
      deleteButton.classList.add("btn", "btn-danger", "btn-sm");

      deleteButton.innerHTML = this.trashIcon;
      deleteButton.onclick = () => this.destroy(task);

      row.insertCell().appendChild(deleteButton);
    });
  }

  mountDoneTab(data) {
    const table = document.querySelector("table#done-tasks tbody");
    table.innerHTML = "";

    data.map((task) => {
      const row = table.insertRow();

      // change status button: do
      const changeSttsToDoBtn = document.createElement("button");
      changeSttsToDoBtn.classList.add("btn", "btn-primary", "btn-sm");
      changeSttsToDoBtn.innerHTML = "Fazer";
      changeSttsToDoBtn.onclick = () => this.changeStatus(task, "do");

      // change status button: doing
      const changeSttsToDoingBtn = document.createElement("button");
      changeSttsToDoingBtn.classList.add(
        "btn",
        "btn-success",
        "btn-sm",
        "ms-1"
      );
      changeSttsToDoingBtn.innerHTML = "Fazendo";
      changeSttsToDoingBtn.onclick = () => this.changeStatus(task, "doing");

      const titleCell = row.insertCell();
      titleCell.classList.add("fw-semibold", "text-nowrap");
      titleCell.textContent = task.title;

      const descriptionCell = row.insertCell();
      descriptionCell.classList.add("text-nowrap");
      descriptionCell.textContent = task.description;

      const changeSttsCell = row.insertCell();
      changeSttsCell.classList.add("d-flex", "flex-nowrap");
      changeSttsCell.append(changeSttsToDoBtn);
      changeSttsCell.append(changeSttsToDoingBtn);

      const deleteButton = document.createElement("button");
      deleteButton.classList.add("btn", "btn-danger", "btn-sm");

      deleteButton.innerHTML = this.trashIcon;
      deleteButton.onclick = () => this.destroy(task);

      row.insertCell().appendChild(deleteButton);
    });
  }

  async destroy(task) {
    try {
      const confirm = window.confirm(
        'Você tem certeza que deseja deletar a tarefa "'.concat(
          task.title,
          '"?'
        )
      );

      if (confirm) {
        const request = await fetch(
          envs.apiUrl.concat("/task/", task.id.toString(), "/delete"),
          {
            method: "DELETE",
            headers: {
              "Content-Type": "application/json",
            },
          }
        );

        if (request.status !== 200) {
          alert("Erro ao tentar deletar a tarefa.");
          return;
        }

        this.read();
      }
    } catch (error) {
      console.log(error);
      alert("Erro ao tentar deletar a tarefa");
    }
  }

  async changeStatus(task, newStatus) {
    try {
      const confirm = window.confirm(
        'Mudar o status da tarefa "'.concat(
          task.title,
          '" para ',
          this.status[newStatus],
          "?"
        )
      );

      if (confirm) {
        const request = await fetch(
          envs.apiUrl.concat("/task/", task.id.toString(), "/update"),
          {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              title: task.title,
              description: task.description,
              status: newStatus,
            }),
          }
        );

        if (request.status !== 200) {
          alert("Erro ao tentar mudar o status da tarefa.");
          return;
        }

        this.read();
      }
    } catch (error) {
      console.log(error);
      alert("Erro ao tentar mudar o status da tarefa.");
    }
  }
}
