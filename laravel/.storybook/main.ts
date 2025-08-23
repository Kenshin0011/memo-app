import type { StorybookConfig } from "@storybook/vue3-vite";

const config: StorybookConfig = {
  stories: ["../resources/js/**/*.stories.@(js|jsx|mjs|ts|tsx)"],
  addons: ["@storybook/addon-links"],
  framework: {
    name: "@storybook/vue3-vite",
    options: { docgen: "vue-component-meta" },
  },
  docs: { autodocs: true },
  viteFinal: async (config) => {
    config.resolve = config.resolve || {};
    config.resolve.alias = {
      ...config.resolve.alias,
      "@": new URL("../resources/js", import.meta.url).pathname,
    };
    return config;
  },
};

export default config;
