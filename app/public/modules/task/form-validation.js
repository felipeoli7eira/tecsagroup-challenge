export function isFormValid(formData) {
  if (!formData?.title || !formData?.description || !formData?.status) {
    return {
      valid: false,
      message: "Formulário inválido. Um ou mais campos estão vazios.",
    };
  }

  if (
    formData?.status !== "do" &&
    formData?.status !== "doing" &&
    formData?.status !== "done"
  ) {
    return {
      valid: false,
      message: "Formulário inválido. Status não selecionado corretamente.",
    };
  }

  if (formData?.title.length < 1) {
    return {
      valid: false,
      message:
        "Formulário inválido. Título muito curto. Use pelo menos um caractere.",
    };
  }

  if (formData?.title.length > 255) {
    return {
      valid: false,
      message:
        "Formulário inválido. Título muito longo. Use no máximo 255 caractere.",
    };
  }

  if (formData?.description.length < 3) {
    return {
      valid: false,
      message:
        "Formulário inválido. Descrição muito curta. Use pelo menos 3 caracteres.",
    };
  }

  if (formData?.description.length > 255) {
    return {
      valid: false,
      message:
        "Formulário inválido. Descrição muito longa. Use no máximo 255 caracteres.",
    };
  }

  return {
    valid: true,
    message: "",
  };
}
