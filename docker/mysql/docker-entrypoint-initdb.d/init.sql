DROP SCHEMA IF EXISTS db_mydb;
CREATE SCHEMA db_mydb;
USE db_mydb;
-- DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `user_img` VARCHAR(255) UNIQUE NOT NULL,
  `agent_id` INT NOT NULL,
  `name` VARCHAR(255) UNIQUE NOT NULL,
  `department_name` VARCHAR(255) NOT NULL,
  `tel` VARCHAR(255) UNIQUE NOT NULL,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO
  `users` (
    `user_img`,
    `agent_id`,
    `name`,
    `department_name`,
    `tel`,
    `email`,
    `password`
  )
VALUES
  (
    '秋元 真夏',
    '1',
    '秋元 真夏',
    '人事部',
    '000-0000-0000',
    'manatsu@gmail.com',
    sha1('manatsu')
  ),
  (
    '賀喜 遥香',
    '1',
    '賀喜 遥香',
    '人事部',
    '000-0000-0001',
    'haruka@gmail.com',
    sha1('haruka')
  ),
  (
    '林 瑠奈',
    '1',
    '林 瑠奈',
    '人事部',
    '000-0000-0003',
    'runa@gmail.com',
    sha1('runa')
  ),
  (
    '齋藤 飛鳥',
    '2',
    '齋藤 飛鳥',
    '人事部',
    '000-0000-0004',
    'asuka@gmail.com',
    sha1('asuka')
  ),
  (
    '鈴木 絢音',
    '2',
    '鈴木 絢音',
    '人事部',
    '000-0000-0005',
    'ayane@gmail.com',
    sha1('ayane')
  ),
  (
    '岩本 蓮加',
    '2',
    '岩本 蓮加',
    '人事部',
    '000-0000-0006',
    'renka@gmail.com',
    sha1('renka')
  ),
  (
    '山下 美月',
    '3',
    '山下 美月',
    '人事部',
    '000-0000-0007',
    'mizuki@gmail.com',
    sha1('mizuki')
  ),
  (
    '掛橋 沙耶香',
    '3',
    '掛橋 沙耶香',
    '人事部',
    '000-0000-0008',
    'sayaka@gmail.com',
    sha1('sayaka')
  ),
  (
    '柴田 柚菜',
    '3',
    '柴田 柚菜',
    '人事部',
    '000-0000-0009',
    'yuna@gmail.com',
    sha1('yuna')
  ),
  (
    '梅澤 美波',
    '4',
    '梅澤 美波',
    '人事部',
    '000-0000-0010',
    'minami@gmail.com',
    sha1('minami')
  ),
  (
    '金川 紗耶',
    '4',
    '金川 紗耶',
    '人事部',
    '000-0000-0011',
    'saya@gmail.com',
    sha1('saya')
  ),
  (
    '田村 真佑',
    '4',
    '田村 真佑',
    '人事部',
    '000-0000-0012',
    'mayu@gmail.com',
    sha1('mayu')
  ),
  (
    '与田 祐希',
    '5',
    '与田 祐希',
    '人事部',
    '000-0000-0013',
    'yuki@gmail.com',
    sha1('yuki')
  ),
  (
    '佐藤 楓',
    '5',
    '佐藤 楓',
    '人事部',
    '000-0000-0014',
    'kaede@gmail.com',
    sha1('kaede')
  ),
  (
    '阪口 珠美',
    '5',
    '阪口 珠美',
    '人事部',
    '000-0000-0015',
    'tamtami@gmail.com',
    sha1('tamami')
  ),
  (
    '遠藤 さくら',
    '6',
    '遠藤 さくら',
    '人事部',
    '000-0000-0016',
    'sakura@gmail.com',
    sha1('sakura')
  ),
  (
    '清宮 レイ',
    '6',
    '清宮 レイ',
    '人事部',
    '000-0000-0017',
    'rei@gmail.com',
    sha1('rei')
  ),
  (
    '菅原 咲月',
    '6',
    '菅原 咲月',
    '人事部',
    '000-0000-0018',
    'satsuki@gmail.com',
    sha1('satsuki')
  ),
  (
    '久保 史緒里',
    '7',
    '久保 史緒里',
    '人事部',
    '000-0000-0019',
    'shiori@gmail.com',
    sha1('shiori')
  ),
  (
    '筒井 あやめ',
    '7',
    '筒井 あやめ',
    '人事部',
    '000-0000-0020',
    'ayame@gmail.com',
    sha1('ayame')
  ),
  (
    '早川 聖来',
    '7',
    '早川 聖来',
    '人事部',
    '000-0000-0021',
    'seira@gmail.com',
    sha1('seira')
  );


DROP TABLE IF EXISTS apply_info;
CREATE TABLE apply_info (
  `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `name` VARCHAR(225) NOT NULL,
  `kana` VARCHAR(225) NOT NULL,
  `tel` VARCHAR(225) NOT NULL,
  `email` VARCHAR(225) NOT NULL,
  `college` VARCHAR(225) NOT NULL,
  `faculty` VARCHAR(225) NOT NULL,
  `graduate_year` VARCHAR(225) NOT NULL,
  `adress` VARCHAR(225) NOT NULL,
  `free` VARCHAR(225) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
DROP TABLE IF EXISTS userpassreset;
CREATE TABLE `userpassreset` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `token` TEXT NOT NULL,
  `mail` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
DROP TABLE IF EXISTS agent;
CREATE TABLE `agent` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `agent_name` TEXT NOT NULL,
  `link` TEXT NOT NULL,
  `image` TEXT NOT NULL,
  `publisher_five` INT NOT NULL,
  `decision_five` INT NOT NULL,
  `speed_five` INT NOT NULL,
  `registstrant_five` INT NOT NULL,
  `place_five` INT NOT NULL,
  `publisher` INT NOT NULL,
  `decision` INT NOT NULL,
  `speed` INT NOT NULL,
  `registstrant` INT NOT NULL,
  `place` INT NOT NULL,
  `main` TEXT NOT NULL,
  `sub` TEXT NOT NULL,
  `step1` TEXT NOT NULL,
  `step2` TEXT NOT NULL,
  `step3` TEXT NOT NULL,
  `mail` TEXT NOT NULL,
  `tel` TEXT NOT NULL,
  `apeal1` TEXT NOT NULL,
  `apeal1_content` TEXT NOT NULL,
  `apeal2` TEXT NOT NULL,
  `apeal2_content` TEXT NOT NULL,
  `deadline` TEXT NOT NULL
);
INSERT INTO
  `agent` (
    `agent_name`,
    `link`,
    `image`,
    `publisher_five`,
    `decision_five`,
    `speed_five`,
    `registstrant_five`,
    `place_five`,
    `publisher`,
    `decision`,
    `speed`,
    `registstrant`,
    `place`,
    `main`,
    `sub`,
    `step1`,
    `step2`,
    `step3`,
    `mail`,
    `tel`,
    `apeal1`,
    `apeal1_content`,
    `apeal2`,
    `apeal2_content`,
    `deadline`
  )
VALUES
  (
    'マイナビ',
    'https://shinsotsu.mynavi-agent.jp/',
    'mynabi',
    2,
    3,
    4,
    5,
    1,
    30000,
    50000,
    2,
    100000,
    8,
    '就活はひとりじゃない、ともに進む就活',
    '就活サイトでは掲載されてない求人',
    '一歩目',
    '二歩目',
    '三歩目',
    'mynabi@co.jp',
    '0120-500-500',
    'キャリアアドバイザーと二人三脚で就活に勝つ',
    '膨大な情報量の中から、自分に必要な情報だけを ピックアップするのは難しいもの。 それぞれ専門知識のあるキャリアアドバイザーが、 効率的な就活を皆さまに合わせたサポートをさせて いただきます。',
    'キャリアアドバイザーと二人三脚で就活に勝つ',
    'マイナビ新卒紹介では、マイナビなど就職情報 サイトには公開されていない、非公開求人を中心に ご紹介します。 マイナビ新卒紹介からしか受けられない求人も 多数ありますので、積極的に活用してください。',
    '2030-04-30'
  ),
  (
    'ミーツカンパニー',
    'https://onl.tw/Uvkpgnj',
    'ミーツカンパニー',
    5,
    4,
    3,
    4,
    2,
    30000,
    50000,
    2,
    100000,
    8,
    '就活はひとりじゃない、ともに進む就活',
    '就活サイトでは掲載されてない求人',
    '会員登録',
    '面談',
    '選考支援',
    'meetscompany@meet.com',
    '000-0000-0000',
    'Meets Company限定の特別選考もあり',
    '求人企業の採用担当や社長と直接交渉ができるから、通常とは異なるルートで選考に進めます！なんと一次面接から社長と面接ができるフローなどもございます。',
    '二人三脚で内定までサポート',
    '希望条件や、就職に対する不安など、どんなことでもお話ください。プロのエージェントによる企業紹介や個別面談などを通じ、企業との最適なマッチングを目指します。',
    '2030-04-30'
  ),
  (
    'キャリアチケット',
    'https://onl.tw/BFaWwzi',
    'キャリアチケット',
    5,
    5,
    3,
    5,
    3,
    80000,
    60000,
    3,
    200000,
    10,
    '6月中に 内定が欲しいあなたへ',
    '受けるのは、 自分に合う数社だけ。',
    '初回面接',
    '資料送付',
    '選考支援',
    'careerticket@career.com',
    '000-1111-2222',
    '話すだけで、 あなたに合う企業がわかる',
    '合う企業を見つけるため、まずはあなたにヒアリング。 年間1万人以上をサポートするアドバイザーだから、 あなたの良さをしっかり理解してくれます。',
    'あなたの魅力が 伝わるようになる',
    '専任アドバイザーが、あなたの強み、選考先に合わせて 1社ずつ選考対策。人事に刺さる"伝え方"をアドバイザーが しっかりと教えてくれます。 対策後の内定率は39%もUP！',
    '2030-04-30'
  ),
  (
    'イロダスサロン',
    'https://onl.tw/Uugtjk4',
    'イロダスサロン',
    2,
    3,
    1,
    5,
    4,
    20000,
    15000,
    11,
    90000,
    15,
    'いい会社じゃなく、いい人生に出逢える場所',
    'コミュニティ型就活支援サービス',
    '簡単登録',
    '面談',
    '就活支援',
    'irodas@irodas.com',
    '000-1111-0000',
    'キャリア講座・面談の満足度95%',
    'irodasSALON(イロダスサロン)では、10種以上のキャリア講座・メンター面談を就活生へ提供しています。その講座・面談が高く評価され、95%以上の満足度をいただいております。さらに、利用ユーザーの75%が「友人に紹介したい」と答えています。',
    'プロのアドバイザーによる就活サポート',
    'irodasSALONでは、キャリアメンターが就活生の自己分析や選考対策のサポート、一人ひとりに合った企業のご紹介を行っています。',
    '2030-04-30'
  ),
  (
    'キャリセン就活',
    'https://onl.tw/dBMwKX5',
    'キャリセン就活',
    2,
    5,
    1,
    5,
    1,
    20000,
    60000,
    9,
    300000,
    3,
    '「プロの視点」で始める就活支援サービス',
    '実績があるからあなたに合った企業をご紹介',
    '無料相談予約',
    'web面談',
    '応募・選考',
    'careecen@careecen.com',
    '000-3333-5555',
    '自己PR、強みがわからない',
    'あなたの経験を元に客観性も交えながら答えに導きます',
    '自分に合った企業が分からない',
    '企業のホンネを熟知しているので、あなたの適性にあった企業を紹介できます',
    '2030-04-30'
  ),
  (
    'doda',
    'https://doda-student.jp/',
    'doda',
    4,
    4,
    3,
    5,
    2,
    40000,
    50000,
    3,
    150000,
    7,
    '見つけた！私にとっての「No.1企業」',
    '丁寧なカウンセリングであなたの強みや適性を明確に！',
    'カウンセリング',
    '企業紹介',
    '面談対策',
    'doda@doda.com',
    '000-2222-9999',
    '強み・志向性などを明確にする内定支援カウンセリング！',
    'あなたに一番合った企業を紹介できるよう専任のキャリアアドバイザーが丁寧にヒアリング。入社したい企業を決めるうえで一番大切な「就職の軸」を明らかにします。',
    'プロが厳選した優良企業・成長企業が5500社以上！',
    'doda新卒エージェントがプロの視点で見極めた優良・成長企業が5500社以上も。あなたに一番合った就職先がきっと見つかります！',
    '2030-04-30'
  ),
  (
    'リクナビ',
    'http://job.rikunabi.com/agent/',
    'リクナビ',
    4,
    2,
    1,
    5,
    5,
    50000,
    20000,
    5,
    500000,
    20,
    '就活は専任アドバイザーと。',
    '一緒に見つけよう、働きたい会社を',
    '登録',
    '面談',
    '業界研究',
    'rikunabi@rikunabi.com',
    '000-2222-2222',
    'リクナビとの違い',
    'あなたが受けるべき求人を専任のアドバイザーが直接ご紹介するのがリクナビ就職エージェントです。',
    'リクナビ就職エージェントに登録すると・・・',
    'あなたの志向・価値観に合った企業を直接ご紹介。面接アドバイスや履歴書添削が何度でも可能。履歴書１枚で複数の企業にエントリーが可能。',
    '2030-04-30'
  );
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tag_name` TEXT NOT NULL
);
INSERT INTO
  `tag` (`tag_name`)
VALUES
  ('面接対策'),
  ('ES添削'),
  ('1on1'),
  ('オンライン'),
  ('対面'),
  ('非公開求人'),
  ('IT'),
  ('マスコミ'),
  ('商社'),
  ('金融'),
  ('外資'),
  ('総合'),
  ('スタートアップ'),
  ('ベンチャー'),
  ('大手'),
  ('首都圏'),
  ('関西'),
  ('地方');
CREATE TABLE `agent_tag` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `agent_id` INT NOT NULL,
  `tag_id` INT NOT NULL
);
CREATE TABLE `agent_user` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `agent_id` INT NOT NULL,
  `user_id` INT NOT NULL
);
DROP TABLE IF EXISTS edit_agent;
CREATE TABLE `edit_agent` (
  `id` INT NOT NULL,
  `agent_name` TEXT NOT NULL,
  `link` TEXT NOT NULL,
  `image` TEXT NOT NULL,
  `publisher_five` INT NOT NULL,
  `decision_five` INT NOT NULL,
  `speed_five` INT NOT NULL,
  `registstrant_five` INT NOT NULL,
  `place_five` INT NOT NULL,
  `publisher` INT NOT NULL,
  `decision` INT NOT NULL,
  `speed` INT NOT NULL,
  `registstrant` INT NOT NULL,
  `place` INT NOT NULL,
  `main` TEXT NOT NULL,
  `sub` TEXT NOT NULL,
  `step1` TEXT NOT NULL,
  `step2` TEXT NOT NULL,
  `step3` TEXT NOT NULL,
  `mail` TEXT NOT NULL,
  `tel` TEXT NOT NULL,
  `apeal1` TEXT NOT NULL,
  `apeal1_content` TEXT NOT NULL,
  `apeal2` TEXT NOT NULL,
  `apeal2_content` TEXT NOT NULL,
  `deadline` TEXT NOT NULL
);
DROP TABLE IF EXISTS `edit_tag`;
CREATE TABLE `edit_tag` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tag_name` TEXT NOT NULL
);
DROP TABLE IF EXISTS `edit_agent_tag`;
CREATE TABLE `edit_agent_tag` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `agent_id` INT NOT NULL,
  `tag_id` INT NOT NULL
);