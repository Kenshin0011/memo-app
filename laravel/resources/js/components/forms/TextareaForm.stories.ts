import type { Meta, StoryObj } from "@storybook/vue3";
import TextareaForm from "./TextareaForm.vue";
import { ref } from "vue";

const meta: Meta<typeof TextareaForm> = {
  title: "Components/Forms/TextareaForm",
  component: TextareaForm,
  parameters: {
    layout: "centered",
  },
  argTypes: {
    placeholder: { control: "text" },
    rows: { control: "number" },
    modelValue: { control: "text" },
  },
};

export default meta;
type Story = StoryObj<typeof meta>;

/**
 * 基本的なテキストエリアフォーム
 */
export const Default: Story = {
  args: {
    placeholder: "メモを入力してください",
    rows: 4,
    modelValue: "",
  },
  render: (args) => ({
    components: { TextareaForm },
    setup() {
      const model = ref(args.modelValue || "");
      return { args, model };
    },
    template: `
      <div class="w-96">
        <TextareaForm 
          v-model="model" 
          :placeholder="args.placeholder" 
          :rows="args.rows"
          @submit="() => console.log('Submit:', model)"
        />
        <p class="mt-2 text-sm text-gray-600">入力値: {{ model }}</p>
      </div>
    `,
  }),
};

/**
 * プレースホルダー付きのテキストエリア
 */
export const WithPlaceholder: Story = {
  args: {
    placeholder: "今日の出来事を記録しましょう...",
    rows: 6,
    modelValue: "",
  },
  render: (args) => ({
    components: { TextareaForm },
    setup() {
      const model = ref(args.modelValue || "");
      return { args, model };
    },
    template: `
      <div class="w-96">
        <TextareaForm 
          v-model="model" 
          :placeholder="args.placeholder" 
          :rows="args.rows"
          @submit="() => console.log('Submit:', model)"
        />
      </div>
    `,
  }),
};

/**
 * 初期値が設定されたテキストエリア
 */
export const WithInitialValue: Story = {
  args: {
    placeholder: "メモを編集してください",
    rows: 5,
    modelValue: "これは初期値として設定されたメモの内容です。\nEnterキーで送信できます。",
  },
  render: (args) => ({
    components: { TextareaForm },
    setup() {
      const model = ref(args.modelValue || "");
      return { args, model };
    },
    template: `
      <div class="w-96">
        <TextareaForm 
          v-model="model" 
          :placeholder="args.placeholder" 
          :rows="args.rows"
          @submit="() => console.log('Submit:', model)"
        />
        <p class="mt-2 text-sm text-gray-600">現在の文字数: {{ model.length }}</p>
      </div>
    `,
  }),
};

/**
 * 小さいサイズのテキストエリア
 */
export const Compact: Story = {
  args: {
    placeholder: "短いメモ",
    rows: 2,
    modelValue: "",
  },
  render: (args) => ({
    components: { TextareaForm },
    setup() {
      const model = ref(args.modelValue || "");
      return { args, model };
    },
    template: `
      <div class="w-64">
        <TextareaForm 
          v-model="model" 
          :placeholder="args.placeholder" 
          :rows="args.rows"
          @submit="() => console.log('Submit:', model)"
        />
      </div>
    `,
  }),
};