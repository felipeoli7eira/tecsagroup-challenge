import envs from "../../envs.js";

export class CreateTask {
  constructor() {
    console.log("Create task module installed 🚀");
  }

  handleSubmit() {
    document.forms.createTaskForm.onsubmit = async (event) => {
      event.preventDefault();

      const form = new FormData(
        document.querySelector("form[name=createTaskForm]")
      );

      const formData = Object.fromEntries(form.entries());

      await this.send(formData);

      //   if (!this.isFormValid(formData)) {
      //     alert("Formulário inválido. Verifique e tente novamente");
      //   }
    };
  }

  isFormValid(formData) {}

  async send(formData) {
    try {
      const response = await fetch(envs.apiUrl.concat("/task"), {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      });

      console.log(response);

      if (response.status !== 201) {
        alert("Erro ao criar a nova tareda.");
        return;
      }

      window.location.href = "/";
    } catch (error) {
      console.log(error);
      alert("Erro ao criar a nova tareda.");
    }
  }
}
