import Card from "./Card.tsx";

const Benefits = () => {
  return (
    <div className="mt-20">
      <h2 className="font-medium text-[24px] xl:text-[32px] text-[#a3a3a3]">
        В приложении вы также найдете:
      </h2>
      <div className="grid grid-cols-1 grid-rows-6 xl:grid-rows-2 xl:grid-cols-3  gap-4 mt-10">
        <Card
          text="Полезные новости про спорт и здоровье"
          src="/Megaphone.png"
        ></Card>
        <Card text="Большой выбор активностей" src="/sskoo.png"></Card>
        <Card
          text="Планы тренировок и ивенты от фондов"
          src="/calendar.png"
        ></Card>
        <Card
          text="Мотивирующие stepsstori от других пользователей"
          src="/Lamp.png"
        ></Card>
        <Card text="Рейтинг участников" src="/Trophy.png"></Card>
        <Card
          text="Возможность выбрать фонд для благотворительности"
          src="/Gift.png"
        ></Card>
      </div>
    </div>
  );
};

export default Benefits;
