import api from "@/bootstrap";
import { CreateMemoPayload, Memo } from "@/features/memos/types/memoTypes";
import { useMemosStore } from "@/features/memos/stores/memosStore.ts";

const BASE_URL = "/memos";

const memosStore = useMemosStore();

/**
 * メモ一覧を取得する
 */
export const fetchMemos = async () => {
  try {
    const { data } = await api.get<Memo[]>(BASE_URL);
    memosStore.store(data);
    return { success: true, data: data };
  } catch (error) {
    return { success: false, error };
  }
};

/**
 * メモ作成する
 * @param payload
 */
export const createMemo = async (payload: CreateMemoPayload) => {
  try {
    const { data } = await api.post(BASE_URL, payload);
    memosStore.addMemo(data.data);
    return { success: true, message: data.message };
  } catch (error) {
    return { success: false, error };
  }
};
