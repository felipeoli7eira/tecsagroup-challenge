import envs from "../../envs.js";

export class Create {
  constructor() {
    console.log("Create task module installed 🚀");
  }

  mount() {
    this.handleSubmit();
  }

  handleSubmit() {
    document.forms.createForm.onsubmit = async (event) => {
      event.preventDefault();

      const form = new FormData(
        document.querySelector("form[name=createForm]")
      );

      const formData = Object.fromEntries(form.entries());

      if (!this.isFormValid(formData)) {
        alert("Formulário inválido. Verifique e tente novamente");
        return;
      }

      await this.send(formData);
    };
  }

  isFormValid(formData) {
    return true;
  }

  async send(formData) {
    try {
      const response = await fetch(envs.apiUrl.concat("/task"), {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      });

      if (response.status !== 201) {
        alert("Erro ao criar a nova tarefa.");
        return;
      }

      window.location.href = "/";
    } catch (error) {
      console.log(error);
      alert("Erro ao criar a nova tarefa.");
    }
  }
}
