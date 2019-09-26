<?php

/**
 * AbsModel
 * @author Dheo
 */
abstract class AbsModel extends AbsRetorno implements Imodel {

    public function create($request) {
        $Create = new Create();
        $Create->ExeCreate($this->table, $request);
        return $this->defaultReturn($Create);
    }

    public function destroy($id) {
        $Delete = new Delete();
        $Delete->ExeDelete($this->table, SQLHelper::whereById(), "id={$id}");
        return $this->defaultReturn($Delete);
    }

    public function update($request, $id) {
        $Update = new Update();
        $Update->ExeUpdate($this->table, $request, SQLHelper::whereById(), "id={$id}");
        return $this->defaultReturn($Update);
    }

}
