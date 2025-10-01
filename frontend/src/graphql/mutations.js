import { gql } from '@apollo/client';

export const PLACE_ORDER = gql`
  mutation PlaceOrder($items: [OrderItemInput!]!) {
    createOrder(items: $items) {
      id
      createdAt
    }
  }
`;
