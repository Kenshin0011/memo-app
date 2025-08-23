import { h } from "vue";
import type { Preview } from "@storybook/vue3";
import "../resources/css/app.css";
import pinia from "../resources/js/plugins/pinia";
import { setup } from "@storybook/vue3-vite";
import * as VueRouter from "vue-router";

const routes = [
  {
    path: "/:any1?/:any2?/:any3?",
    component: h("div", "DEMO"),
  },
];
setup((app) => {
  app.use(pinia).use(VueRouter.createRouter({ history: VueRouter.createWebHistory(), routes }));
});

const preview: Preview = {
  parameters: {
    controls: {
      matchers: {
        color: /(background|color)$/i,
        date: /Date$/i,
      },
    },
  },
};

export default preview;
