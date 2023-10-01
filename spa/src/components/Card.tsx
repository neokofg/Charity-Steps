const Card = ({ text, src }) => {
  return (
    <div className="flex justify-between h-[164px] bg-white rounded-[24px] overflow-hidden	pt-6 pl-8">
      <p className="font-medium text-[18px] xl:text-[24px]">{text}</p>
      <img src={src} className="mt-5" width="150px" height="50%" alt=" " />
    </div>
  );
};

export default Card;
