import { CreateTask } from "./services/create-task.service.js";

const createTaskModule = new CreateTask();

createTaskModule.handleSubmit();
