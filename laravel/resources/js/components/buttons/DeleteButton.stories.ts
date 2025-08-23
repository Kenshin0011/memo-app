import type { Meta, StoryObj } from "@storybook/vue3";
import DeleteButton from "./DeleteButton.vue";

const meta: Meta<typeof DeleteButton> = {
  title: "Components/Buttons/DeleteButton",
  component: DeleteButton,
  parameters: {
    layout: "centered",
  },
  argTypes: {
    disabled: { control: "boolean" },
    ariaLabel: { control: "text" },
  },
};

export default meta;
type Story = StoryObj<typeof meta>;

/**
 * アイテム削除を示すボタンコンポーネント
 */
export const Default: Story = {
  args: {
    disabled: false,
    ariaLabel: "メモを削除",
  },
};

/**
 * 無効化された削除ボタン
 */
export const Disabled: Story = {
  args: {
    disabled: true,
    ariaLabel: "メモを削除（無効）",
  },
};

/**
 * カスタムのaria-labelを使用した削除ボタン
 */
export const WithCustomLabel: Story = {
  args: {
    disabled: false,
    ariaLabel: "アイテム「サンプルメモ」を削除",
  },
};

/**
 * グループホバーで表示される削除ボタンの例
 */
export const InGroupHover: Story = {
  args: {
    disabled: false,
    ariaLabel: "グループホバーで表示される削除ボタン",
  },
  render: (args) => ({
    components: { DeleteButton },
    setup() {
      return { args };
    },
    template: `
      <div>
        <p class="mb-4 text-gray-600">カードにホバーすると削除ボタンが表示されます：</p>
        <div class="group hover:bg-gray-100 p-4 rounded border">
          <div class="flex justify-between items-center">
            <span>サンプルメモの内容...</span>
            <DeleteButton v-bind="args" class="opacity-0 group-hover:opacity-100 transition-opacity" />
          </div>
        </div>
      </div>
    `,
  }),
};
