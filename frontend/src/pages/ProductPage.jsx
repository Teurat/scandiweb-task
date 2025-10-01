import { useParams } from 'react-router-dom';
import { useQuery } from '@apollo/client';
import { GET_PRODUCT } from '../graphql/queries';
import ProductGallery from '../components/Product/ProductGallery';
import AttributeSelector from '../components/Product/AttributeSelector';
import { useState } from 'react';
import { useCart } from '../context/CartContext';
import formatPrice from '../utils/formatPrice';
import { toast } from 'react-toastify';
import DOMPurify from 'dompurify';
import parse from 'html-react-parser';

export default function ProductPage() {
  const { id } = useParams();
  const { data, loading } = useQuery(GET_PRODUCT, { variables: { id } });
  const { dispatch, setOpen } = useCart();
  const [selected, setSelected] = useState({});

  if (loading) return <p>Loading…</p>;
  if (!data || !data.product) return <p>Product not found</p>;

  const p = {
    ...data.product,
    attributes: data.product.attributes.map((attr) => {
      const attrKey = attr.label.toLowerCase().replace(/\s+/g, '-');
      return {
        ...attr,
        attrKey,
      };
    }),
  };

  const isOutOfStock = p?.inStock === false;
  const allSelected = p.attributes.every((attr) => selected[attr.attrKey]);

  const handleAdd = () => {
    if (!allSelected) return;

    const selectedAttrs = {};
    p.attributes.forEach((attr) => {
      const selectedValue = selected[attr.attrKey];
      const match = attr.values.find((v) => v.value === selectedValue);
      if (match) {
        selectedAttrs[attr.label] = match.value;
      }
    });

    const stableAttrs = Object.entries(selectedAttrs).sort();
    const key = JSON.stringify([p.id, stableAttrs]);

    dispatch({
      type: 'ADD',
      payload: {
        id: p.id,
        name: p.name,
        prices: p.prices,
        selectedAttrs,
        gallery: p.gallery,
        key,
      },
    });

    setOpen(true);
    toast.success(`Added "${p.name}" to cart 🎉`);
  };

  const isAddButtonDisabled = !allSelected || isOutOfStock;

  return (
    <div className="flex justify-center items-start my-16 mx-20 gap-24">
      <ProductGallery images={p.gallery} />

      <div className="w-[35%]">
        <h2 className="text-3xl font-semibold mb-8 tracking-wide">{p.name}</h2>

        {p.attributes.map((attr) => (
          <div key={attr.attrKey} className="mb-8">
            <AttributeSelector
              attr={attr}
              selected={selected[attr.attrKey]}
              onSelect={(value) =>
                setSelected((s) => ({ ...s, [attr.attrKey]: value }))
              }
            />
          </div>
        ))}

        <p className="mb-2 text-xs font-semibold uppercase">Price:</p>
        <p className="text-xl font-medium mb-8">
          {formatPrice(p.prices[0].amount)}
        </p>

        <button
          data-testid="add-to-cart"
          onClick={handleAdd}
          disabled={isAddButtonDisabled}
          className={`w-full h-12 uppercase text-white font-medium tracking-wide ${
            isAddButtonDisabled
              ? 'bg-gray-300 cursor-not-allowed'
              : 'bg-[#5ECE7B] hover:bg-[#4BBF6F]'
          }`}
        >
          {!isOutOfStock ? 'Add to Cart' : 'Out of Stock'}
        </button>

        <article
          data-testid="product-description"
          className="mt-6 text-sm leading-relaxed text-gray-600
             [&_h3]:mt-4 [&_h3]:font-semibold
             [&_ul]:list-disc [&_ul]:pl-5 [&_li]:mb-1">
          {parse(DOMPurify.sanitize(p.description || '', { USE_PROFILES: { html: true } }))}
        </article>

      </div>
    </div>
  );
}
