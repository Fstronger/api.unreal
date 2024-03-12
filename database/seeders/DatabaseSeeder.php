<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\RefCharacteristics;
use App\Models\RefFactions;
use App\Models\RefHeroesFactions;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => Hash::make('password')
        ]);

        DB::table('user_characteristics')->insert(
            [
                'user_id' => 1,
                'characteristic_id' => RefCharacteristics::ATTACK,
                'current_amount' => 15,
                'amount' => 999999
            ]
        );

        DB::table('user_characteristics')->insert(
            [
                'user_id' => 1,
                'characteristic_id' => RefCharacteristics::ARMOR,
                'current_amount' => 20,
                'amount' => 999999
            ]
        );

        DB::table('user_characteristics')->insert(
            [
                'user_id' => 1,
                'characteristic_id' => RefCharacteristics::HP,
                'current_amount' => 95,
                'amount' => 100
            ]
        );

        DB::table('ref_factions')->insert([
            'name' => 'Корпорация Глобалис',
            'description' => 'Корпорация Глобалис - могучий и влиятельный монополист в мире киберпанка. Она контролирует огромные ресурсы, включая передовые технологии, и доминирует на мировом рынке. Внутри компании царит строгая и безжалостная иерархия, где только самые способные и беспощадные сотрудники могут добиться успеха. Корпорация Глобалис разрабатывает киберинтерфейсы, искусственный интеллект, киберпротезы и умные города. В то время как она предоставляет многочисленные удобства и технологические решения, ее деятельность также вызывает волнения из-за возможности массового контроля и угрозы приватности человека.',
            'image' => 'none'
        ]);

        DB::table('ref_factions')->insert([
            'name' => 'Синдикат Нефтезаряда',
            'description' => 'Синдикат Нефтезаряда - таинственный киберпреступный синдикат, специализирующийся на контрабанде и кибертерроризме. Эта фракция занимается незаконными операциями, такими как кража ценных технологий, шантаж и хакерские атаки на крупные корпорации. Синдикат пользуется глубокими знаниями в области киберпространства и всегда находится в поиске средств для дестабилизации корпоративного мира и нарушения мирового порядка. Внешне они остаются скрытыми в тени, управляя своими операциями через сеть анонимных хакерских лейеров.',
            'image' => 'none'
        ]);

        DB::table('ref_factions')->insert([
            'name' => 'Анархохакеры Кибернетики',
            'description' => 'Анархохакеры Кибернетики - группировка киберактивистов, которая стремится к свободе информации и отказу от корпоративного контроля. Они верят, что все технологии должны быть доступны каждому человеку и не подвержены цензуре или манипуляции. Анархохакеры считают себя стражами киберпространства, борясь против корпораций и правительств, которые стремятся манипулировать людьми через технологии. Они проводят децентрализованные атаки и взломы, чтобы раскрыть скрытую правду и бороться за свободу виртуального мира. Внешне они скрывают свои истинные лица за кибермасками и носят символы анонимности и свободы на своей одежде.',
            'image' => 'none'
        ]);

        DB::table('ref_heroes_factions')->insert([
            'name' => 'Алексей Хардкорт',
            'faction_id' => 1,
            'description' => 'Алексей Хардкорт - выдающийся киберинженер и главный ученый Корпорации Глобалис. Его гениальные изобретения и технологические открытия позволяют компании всегда оставаться на переднем крае прогресса. Он обладает бесконечной страстью к исследованиям, давая предпочтение работе над собой и своими экспериментами, чем общению с другими людьми. Всегда носит характерные киберпанковские очки с ультрафиолетовыми линзами.',
            'image' => 'none'
        ]);

        DB::table('ref_heroes_factions')->insert([
            'name' => 'Эмилия Серебро',
            'faction_id' => 1,
            'description' => 'Эмилия Серебро - преуспевающая бизнес-леди и управляющая директорка Корпорации Глобалис. Ее ум и стратегические способности позволили компании доминировать на рынке и контролировать огромные технологические ресурсы. Внешне всегда выглядит безупречно, носит стильные киберпанковские наряды и дорогостоящие кибер-аксессуары. За стальным характером скрывает тайны, которые могут потрясти всю корпорацию.',
            'image' => 'none'
        ]);

        DB::table('ref_heroes_factions')->insert([
            'name' => 'Левиафан Драстик',
            'faction_id' => 1,
            'description' => 'Левиафан Драстик - легендарный кибернетический боец и глава охранной службы Корпорации Глобалис. Бывший военный киборг, который стал символом силы и безжалостности компании. Всегда одет в массивную киберброню и вооружен передовым оружием. Лично участвовал во множестве операций по захвату технологических секретов у конкурирующих фракций.',
            'image' => 'none'
        ]);

        DB::table('ref_heroes_factions')->insert([
            'name' => 'Анна "Кат" Гримм',
            'faction_id' => 2,
            'description' => 'Анна Гримм, известная в киберподполье как "Кат", является виртуозной кибер-акробаткой и ассасином в рядах Синдиката Нефтезаряда. Она виртуозно владеет агрессивной стилистикой и боевыми искусствами, что делает ее поистине опасным противником. Анна предпочитает держаться в тени, одевается в черные киберкостюмы с различными шипами и острыми кибер-оружиями.',
            'image' => 'none'
        ]);

        DB::table('ref_heroes_factions')->insert([
            'name' => 'Ника Турбулент',
            'faction_id' => 2,
            'description' => 'Ника Турбулент - талантливый хакер и основатель Синдиката Нефтезаряда. Ее умение взламывать самые защищенные системы сделало ее легендой в мире киберпреступности. Ника носит яркие цветные прически, украшенные киберинками, и всегда скрывается за стильной кибермаской, чтобы оставаться инкогнито.',
            'image' => 'none'
        ]);

        DB::table('ref_heroes_factions')->insert([
            'name' => 'Максим Черновоз',
            'faction_id' => 2,
            'description' => 'Максим Черновоз - харизматичный гангстер и правая рука Ники Турбулент. Его стратегический ум и жестокость сделали его одним из влиятельнейших членов синдиката. Он всегда одет в черные кожаные киберкостюмы с технологичными усилителями и оружием.',
            'image' => 'none'
        ]);

        DB::table('ref_heroes_factions')->insert([
            'name' => 'Дэнвер Локдаун',
            'faction_id' => 3,
            'description' => 'Дэнвер Локдаун - гениальный хакер и лидер Анархохакеров Кибернетики. Его идеи и идеалы служат вдохновением для всего синдиката. Он считает, что технологии должны быть свободны и доступны каждому, и борется с контролем корпораций над информацией. Внешне Дэнвер выглядит эксцентрично, с яркими волосами и кибертатуировками.',
            'image' => 'none'
        ]);

        DB::table('ref_heroes_factions')->insert([
            'name' => 'Айра Шифтер',
            'faction_id' => 3,
            'description' => 'Айра Шифтер - кибер-активистка и взломщица систем, работающая в составе Анархохакеров Кибернетики. Она верит, что технологии должны помогать людям и не должны стать инструментом контроля над обществом. Айра носит стильные киберпанковские наряды, украшенные символами свободы.',
            'image' => 'none'
        ]);

        DB::table('ref_heroes_factions')->insert([
            'name' => 'Сэм Блэйд',
            'faction_id' => 3,
            'description' => 'Сэм Блэйд - бывший военный хакер и технический специалист, который перешел на сторону Анархохакеров Кибернетики. Он обладает уникальными навыками в обходе защитных систем и использовании вооружения. Сэм одет в грязно-белые киберкамуфляжи и всегда вооружен передовыми кибер-инструментами.',
            'image' => 'none'
        ]);

        DB::table('ref_characteristics')->insert([
            'name' => 'Атака',
            'icon' => 'none'
        ]);

        DB::table('ref_characteristics')->insert([
            'name' => 'Броня',
            'icon' => 'none'
        ]);

        DB::table('ref_characteristics')->insert([
            'name' => 'Здоровье',
            'icon' => 'none'
        ]);

        for ($i = 1; $i <= 9; $i++)
        {
            // 1 герой
            DB::table('ref_heroes_faction_characteristics')->insert([
                'heroes_id' => $i,
                'characteristic_id' => '1',
                'amount' => rand(9, 20)
            ]);

            DB::table('ref_heroes_faction_characteristics')->insert([
                'heroes_id' => $i,
                'characteristic_id' => '2',
                'amount' => rand(9, 20)
            ]);

            DB::table('ref_heroes_faction_characteristics')->insert([
                'heroes_id' => $i,
                'characteristic_id' => '3',
                'amount' => rand(75, 115)
            ]);
        }

        DB::table('ref_resources')->insert([
            'name' => 'Биток',
            'icon' => 'none'
        ]);

        DB::table('user_resources')->insert([
            'user_id' => 1,
            'resource_id' => 1,
            'amount' => 50,
            'max_amount' => 1000,
        ]);

        DB::table('ref_types_weapons')->insert([
            'name' => 'Ближнее',
            'icon' => 'none'
        ]);

        DB::table('ref_types_weapons')->insert([
            'name' => 'Дальнее',
            'icon' => 'none'
        ]);

        DB::table('ref_types_weapons')->insert([
            'name' => 'Метательное',
            'icon' => 'none'
        ]);

        DB::table('ref_unique_weapons')->insert([
            'name' => 'Обычное',
            'color' => 'gray'
        ]);

        DB::table('ref_unique_weapons')->insert([
            'name' => 'Редкое',
            'color' => 'blue'
        ]);

        DB::table('ref_unique_weapons')->insert([
            'name' => 'Легендарное',
            'color' => 'yellow'
        ]);

        DB::table('ref_unique_weapons')->insert([
            'name' => 'Мифическое',
            'color' => 'purple'
        ]);

        DB::table('all_weapons')->insert([
            'name'=> 'Нож',
            'type_weapon_id' => 1,
            'level' => 1,
            'min_damage' => 5,
            'max_damage' => 15,
            'unique_id' => 1,
            'description' => 'Описание оружия',
            'price' => 150,
            'image' => 'none'
        ]);

        DB::table('all_weapons')->insert([
            'name'=> 'Винтовка',
            'type_weapon_id' => 2,
            'level' => 1,
            'min_damage' => 10,
            'max_damage' => 20,
            'unique_id' => 2,
            'description' => 'Описание оружия',
            'price' => 250,
            'image' => 'none'
        ]);

        DB::table('all_weapons')->insert([
            'name'=> 'Граната',
            'type_weapon_id' => 3,
            'level' => 1,
            'min_damage' => 25,
            'max_damage' => 75,
            'unique_id' => 3,
            'description' => 'Описание оружия',
            'price' => 345,
            'image' => 'none'
        ]);

        DB::table('user_weapons')->insert([
            'user_id' => 1,
            'type_weapon_id' => 1,
            'weapon_id' => 1,
        ]);

        DB::table('user_weapons')->insert([
            'user_id' => 1,
            'type_weapon_id' => 2,
            'weapon_id' => 2,
        ]);

        DB::table('user_weapons')->insert([
            'user_id' => 1,
            'type_weapon_id' => 3,
            'weapon_id' => 3,
        ]);

    }
}
