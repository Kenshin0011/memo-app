import type { Meta, StoryObj } from "@storybook/vue3";
import BaseCard from "./BaseCard.vue";

const meta: Meta<typeof BaseCard> = {
  title: "Components/Cards/BaseCard",
  component: BaseCard,
  parameters: {
    layout: "centered",
  },
  argTypes: {
    variant: {
      control: "select",
      options: ["prominent", "subtle"],
    },
  },
};

export default meta;
type Story = StoryObj<typeof meta>;

/**
 * 目立つスタイルのカードコンポーネント
 */
export const Default: Story = {
  args: {
    variant: "prominent",
  },
  render: (args) => ({
    components: { BaseCard },
    setup() {
      return { args };
    },
    template: `
      <BaseCard v-bind="args" style="width: 400px;">
        <h3 class="text-lg font-semibold mb-2">カードタイトル</h3>
        <p class="text-gray-600">これはBaseCardコンポーネントのサンプル内容です。</p>
      </BaseCard>
    `,
  }),
};

/**
 * 薄いスタイルのカードコンポーネント
 */
export const Subtle: Story = {
  args: {
    variant: "subtle",
  },
  render: (args) => ({
    components: { BaseCard },
    setup() {
      return { args };
    },
    template: `
      <BaseCard v-bind="args" style="width: 400px;">
        <h3 class="text-lg font-semibold mb-2">サブトルカード</h3>
        <p class="text-gray-600">薄いスタイルのカードです。</p>
      </BaseCard>
    `,
  }),
};

/**
 * 長いコンテンツを含むカードコンポーネント
 */
export const WithLongContent: Story = {
  args: {
    variant: "prominent",
  },
  render: (args) => ({
    components: { BaseCard },
    setup() {
      return { args };
    },
    template: `
      <BaseCard v-bind="args" style="width: 400px;">
        <h3 class="text-lg font-semibold mb-2">長いコンテンツのカード</h3>
        <p class="text-gray-600 mb-4">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.
        </p>
        <ul class="list-disc list-inside text-sm text-gray-500">
          <li>アイテム1</li>
          <li>アイテム2</li>
          <li>アイテム3</li>
        </ul>
      </BaseCard>
    `,
  }),
};
