import envs from "../../envs.js";

export class Update {
  status = {
    do: "Fazer",
    doing: "Fazendo",
    done: "Feito",
  };

  id = undefined;

  constructor() {
    console.log("[Update] module mounted 🚀");
  }

  mount() {
    this.getSelectedTask();
  }

  async getSelectedTask() {
    try {
      const idFromUrl = window.location.pathname.replace(/\D+/g, "");

      const idNumber = Number(idFromUrl);

      if (
        isNaN(idNumber) ||
        !Number.isInteger(idNumber) ||
        idNumber === 0 ||
        idFromUrl === ""
      ) {
        alert("Identificador da tarefa não recuperado.");
        window.location.href = "/";
        return;
      }

      this.id = idNumber;

      const request = await fetch(
        envs.apiUrl.concat("/task/", idNumber.toString())
      );

      if (request.status !== 200) {
        alert("Erro ao tentar obter os dados da tarefa selecionada.");
        return;
      }

      const response = await request.json();
      this.mountForm(response);
    } catch (error) {
      console.log(error);
      alert("Erro ao listar as tarefas");
    }
  }

  mountForm(data) {
    const form = document.forms.updateForm;
    document.querySelector(".status-info").textContent =
      this.status[data.status];

    form.querySelector("[name=title]").value = data.title;
    form.querySelector("[name=description]").value = data.description;

    const doOption = document.createElement("option");
    doOption.value = "do";
    doOption.text = "Fazer";

    const doingOption = document.createElement("option");
    doingOption.value = "doing";
    doingOption.text = "Fazendo";

    const doneOption = document.createElement("option");
    doneOption.value = "done";
    doneOption.text = "Feito";

    const selectStatus = form.querySelector("[name=status]");

    if (data.status === "do") {
      selectStatus.appendChild(doingOption);
      selectStatus.appendChild(doneOption);
    }

    if (data.status === "doing") {
      selectStatus.appendChild(doOption);
      selectStatus.appendChild(doneOption);
    }

    if (data.status === "done") {
      selectStatus.appendChild(doOption);
      selectStatus.appendChild(doingOption);
    }

    this.addFormSubmitEventListener();
  }

  addFormSubmitEventListener() {
    const form = document.forms.updateForm;

    form.onsubmit = async (event) => {
      event.preventDefault();

      const form = new FormData(
        document.querySelector("form[name=updateForm]")
      );

      const formData = Object.fromEntries(form.entries());

      await this.update(formData);
    };
  }

  async update(formData) {
    try {
      const request = await fetch(
        envs.apiUrl.concat("/task/", this.id.toString(), "/update"),
        {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            title: formData.title,
            description: formData.description,
            status: formData.status,
          }),
        }
      );

      if (request.status !== 200) {
        alert("Erro ao tentar atualizar a tarefa.");
        return;
      }

      window.location.href = "/";
    } catch (error) {
      console.log(error);
      alert("Erro ao tentar atualizar a tarefa");
    }
  }
}
