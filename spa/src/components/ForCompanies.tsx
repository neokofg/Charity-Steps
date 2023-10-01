import MiniCard from "./MiniCard.tsx";

const ForCompanies = () => {
  return (
    <div>
      <h2 className="font-bold text-[30px] xl:text-[48px] mt-20">
        Для компаний
      </h2>
      <div className="grid grid-cols-1 xl:grid-cols-4 gap-4 mt-10">
        <MiniCard text="Создание новостей и ивентов" />
        <MiniCard text="Возможность выводить развернутую статистику" />
        <MiniCard text="Вывод рейтинг 10 лучших участников" />
        <MiniCard text="Автоматический пересчёт активностей в деньги" />
      </div>
    </div>
  );
};

export default ForCompanies;
