import type { Meta, StoryObj } from "@storybook/vue3";
import Header from "./Header.vue";

const meta: Meta<typeof Header> = {
  title: "Components/Header",
  component: Header,
  parameters: {
    layout: "fullscreen",
  },
};

export default meta;
type Story = StoryObj<typeof meta>;

/**
 * アプリケーションのメインヘッダー
 */
export const Default: Story = {};
