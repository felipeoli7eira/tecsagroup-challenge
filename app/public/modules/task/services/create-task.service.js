import envs from "../../envs.js";
import { isFormValid } from "./../form-validation.js";

export class Create {
  formCheck;

  constructor() {
    console.log("Create task module installed 🚀");

    this.formCheck = isFormValid;
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

      let isFormValid = this.formCheck(formData);

      if (!isFormValid.valid) {
        alert(isFormValid.message);
        return;
      }

      await this.send(formData);
    };
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
