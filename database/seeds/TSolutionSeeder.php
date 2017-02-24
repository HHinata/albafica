<?php

use Illuminate\Database\Seeder;

class TSolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = ['platform' => 'HDU','code' => '<<<CODE
asdjfkl;asjdfk;jasdk;fjsakl;fjdklas;
sadfjkl;adsjfk;asjdfk;asjkdfl;jsadk;fjkadsjfjaksdl;fjkas;d
sajdfkl;asjdfk;ljasdk;fjasdk;kfj
asjdkfl;jsadkl;fjkl;sdajfk;lajsdkfl;
jsakd;fjkadsl;fjkl;sajfkl;asjdkfl;jsdakl;f
CODE;
', 'problem_id'=>1001, 'lang'=>'g++'];

        foreach (range(0, 10) as $item)
        {
            DB::table('tsolution')->insert($record);
        }
    }
}
