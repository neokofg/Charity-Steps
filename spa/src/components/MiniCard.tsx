const MiniCard = ({ text }) => {
  return (
    <div className="bg-white h-[122px] rounded-[24px] px-10 pt-7">
      <p className="font-medium text-[20px]">{text}</p>
    </div>
  );
};

export default MiniCard;
