import { useState } from 'react';

export default function ProductGallery({ images }) {
  const [current, setCurrent] = useState(0);
  const total = images.length;

  const next = () => setCurrent((c) => (c + 1) % total);
  const prev = () => setCurrent((c) => (c - 1 + total) % total);

  return (
    <div data-testid="product-gallery" className="flex gap-8 items-start">
      <div className="flex flex-col gap-3 w-24">
        {images.map((src, i) => (
          <img
            key={i}
            src={src}
            alt={`thumbnail-${i}`}
            onClick={() => setCurrent(i)}
            className={`w-full aspect-square object-cover rounded-md cursor-pointer border transition duration-200 ${
              i === current
                ? 'border-[#5ECE7B]'
                : 'border-gray-300 hover:border-[#5ECE7B]'
            }`}
          />
        ))}
      </div>

      <div className="relative ml-24 flex-1 aspect-square max-w-[600px] rounded-md overflow-hidden bg-white p-4">
        <img
          src={images[current]}
          alt={`image-${current}`}
          className="w-full h-full object-contain"
        />

        {total > 1 && (
          <>
            <button
              onClick={prev}
              className="absolute top-1/2 -translate-y-1/2 left-2 bg-black/50 hover:bg-black/70 text-white text-lg w-8 h-8 flex items-center justify-center rounded-full"
            >
              ‹
            </button>
            <button
              onClick={next}
              className="absolute top-1/2 -translate-y-1/2 right-2 bg-black/50 hover:bg-black/70 text-white text-lg w-8 h-8 flex items-center justify-center rounded-full"
            >
              ›
            </button>
          </>
        )}
      </div>
    </div>
  );
}
